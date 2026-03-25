<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\ImageUpload;

/**
 * PostsAdmin — Full CRUD for the blog/posts CMS.
 *
 * Routes: admin/posts, admin/posts/create, admin/posts/(:num)/edit, etc.
 */
class PostsAdmin extends BaseController
{

    /**
     * Controller for blog post management in the admin panel.
     * Handles listing, creating, editing, updating, and deleting posts.
     * Also manages image uploads and post slugs.
     */
    public function index()
    {
        $data = [
            'pageTitle'  => 'Posts',
            'activePage' => 'posts',
            'posts'      => $this->postModel->orderBy('createdAt', 'DESC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/posts/index', $data)
             . view('admin/layout/footer');
    }

    /**
     * Handle inline image upload from the Quill editor.
     *
     * Accepts a single image file via AJAX POST, saves it to
     * public/uploads/posts/, and returns the URL as JSON.
     **/
    public function uploadImage()
    {
        $file = $this->request->getFile('image');

        if ($file === null || ! $file->isValid()) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'No valid image uploaded.']);
        }

        $uploader = new ImageUpload();
        $path = $uploader->upload($file, 'posts');

        if ($path === null) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => $uploader->getError()]);
        }

        return $this->response->setJSON([
            'url' => site_url($path),
        ]);
    }


    public function create()
    {
        $data = [
            'pageTitle'  => 'New Post',
            'activePage' => 'posts',
        ];

        return view('admin/layout/header', $data)
             . view('admin/posts/form', $data)
             . view('admin/layout/footer');
    }

    public function store()
    {
        $data = [
            'title'            => $this->request->getPost('title'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'category'         => $this->request->getPost('category'),
            'sdgNumbers'       => $this->normalizeSdgNumbers($this->request->getPost('sdgNumbers')),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
            'isFeatured'       => $this->request->getPost('isFeatured') ? 1 : 0,
            'authorName'       => $this->request->getPost('authorName') ?: 'ASOG TBI',
        ];

        // Generate slug
        $data['slug'] = $this->postModel->generateSlug($data['title']);

        // Set publishedAt — use custom date if provided, otherwise default to now
        $customDate = $this->request->getPost('publishedAt');
        if ($data['isPublished']) {
            $data['publishedAt'] = !empty($customDate)
                ? $customDate . ' ' . date('H:i:s')
                : date('Y-m-d H:i:s');
        } elseif (!empty($customDate)) {
            $data['publishedAt'] = $customDate . ' ' . date('H:i:s');
        }

        // Handle image upload
        try {
            $file = $this->request->getFile('image');

            if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                
                // A file was submitted — check if PHP accepted it
                if (! $file->isValid()) {
                    $phpError = $file->getErrorString();
                    setToast('error', 'Image upload failed: ' . $phpError);
                    return redirect()->back()->withInput();
                }

                if ($file->hasMoved()) {
                    setToast('error', 'Image upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $path = $uploader->upload($file, 'posts');
                if ($path !== null) {
                    $data['imagePath'] = $path;

                } else {
                    setToast('error', 'Image upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            setToast('error', 'Image upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        if (! $this->postModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->postModel->errors()));
            return redirect()->back()->withInput();
        }

        $newId = (int) $this->postModel->getInsertID();
        setToast('success', 'Post saved successfully.');
        if ($newId > 0) {
            return redirect()->to(site_url('admin/posts/' . $newId . '/edit'));
        }
        return redirect()->back();
    }

    public function edit(int $id)
    {
        $post = $this->postModel->find($id);

        if (! $post) {
            setToast('error', 'Post not found.');
            return redirect()->to(site_url('admin/posts'));
        }

        $data = [
            'pageTitle'  => 'Edit Post',
            'activePage' => 'posts',
            'post'       => $post,
        ];

        return view('admin/layout/header', $data)
             . view('admin/posts/form', $data)
             . view('admin/layout/footer');
    }


    public function update(int $id)
    {
        $post = $this->postModel->find($id);

        if (! $post) {
            setToast('error', 'Post not found.');
            return redirect()->to(site_url('admin/posts'));
        }

        $data = [
            'title'            => $this->request->getPost('title'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'category'         => $this->request->getPost('category'),
            'sdgNumbers'       => $this->normalizeSdgNumbers($this->request->getPost('sdgNumbers')),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
            'isFeatured'       => $this->request->getPost('isFeatured') ? 1 : 0,
            'authorName'       => $this->request->getPost('authorName') ?: 'ASOG TBI',
        ];

        // Regenerate slug only if title changed
        if ($data['title'] !== $post['title']) {
            $data['slug'] = $this->postModel->generateSlug($data['title'], $id);
        }

        // Set publishedAt — use custom date if provided
        $customDate = $this->request->getPost('publishedAt');
        if (!empty($customDate)) {
            $data['publishedAt'] = $customDate . ' ' . date('H:i:s');
        } elseif ($data['isPublished'] && empty($post['publishedAt'])) {
            $data['publishedAt'] = date('Y-m-d H:i:s');
        }

        // Handle image upload (optional on edit)
        try {
            $file = $this->request->getFile('image');

            if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                
                // A file was submitted — check if PHP accepted it
                if (! $file->isValid()) {
                    $phpError = $file->getErrorString();
                    setToast('error', 'Image upload failed: ' . $phpError);
                    return redirect()->back()->withInput();
                }

                if ($file->hasMoved()) {
                    setToast('error', 'Image upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $path = $uploader->upload($file, 'posts');
                if ($path !== null) {
                    
                    // Delete old image
                    if (! empty($post['imagePath'])) {
                        $uploader->delete($post['imagePath']);
                    }
                    $data['imagePath'] = $path;

                } else {
                    setToast('error', 'Image upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            setToast('error', 'Image upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        if (! $this->postModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->postModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Post saved successfully.');
        return redirect()->to(site_url('admin/posts/' . $id . '/edit'));
    }

    /**
     * Delete a post
     */
    public function delete(int $id)
    {
        $post = $this->postModel->find($id);

        if (! $post) {
            setToast('error', 'Post not found.');
            return redirect()->to(site_url('admin/posts'));
        }

        // Delete image file
        if (! empty($post['imagePath'])) {
            (new ImageUpload())->delete($post['imagePath']);
        }

        $this->postModel->delete($id);

        setToast('success', 'Post deleted.');
        return redirect()->to(site_url('admin/posts'));
    }

    /**
     * Normalize SDG values from form input to a stable CSV like "1,3,12".
     *
     * @param array|string|null $raw
     */
    private function normalizeSdgNumbers($raw): ?string
    {
        if ($raw === null || $raw === '') {
            return null;
        }

        $values = is_array($raw) ? $raw : explode(',', (string) $raw);
        $numbers = [];

        foreach ($values as $value) {
            $id = (int) $value;
            if ($id >= 1 && $id <= 17) {
                $numbers[$id] = $id;
            }
        }

        if ($numbers === []) {
            return null;
        }

        ksort($numbers);
        return implode(',', array_values($numbers));
    }
}