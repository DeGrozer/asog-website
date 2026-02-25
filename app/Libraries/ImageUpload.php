<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;

/**
 * ImageUpload — reusable library for handling image uploads.
 *
 * Usage:
 *   $uploader = new \App\Libraries\ImageUpload();
 *   $path = $uploader->upload($file, 'posts');
 *   // returns relative path like "uploads/posts/abc123.webp" or null on failure
 */
class ImageUpload
{
    /** Base upload directory inside `writable/uploads/`. */
    protected string $basePath;

    /** Maximum file size in KB. */
    protected int $maxSize = 2048; // 2 MB

    /** Allowed MIME types. */
    protected array $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
    ];

    /** Last error message. */
    protected string $error = '';

    public function __construct()
    {
        $this->basePath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR;
    }

    /**
     * Upload an image file to the given subfolder.
     *
     * @param  UploadedFile|null $file       The uploaded file instance.
     * @param  string            $subfolder  e.g. "posts", "team"
     * @return string|null                   Relative path from writable/ or null on failure.
     */
    public function upload(?UploadedFile $file, string $subfolder = 'posts'): ?string
    {
        if ($file === null || ! $file->isValid() || $file->hasMoved()) {
            $this->error = 'No valid file was uploaded.';
            return null;
        }

        // Validate MIME
        if (! in_array($file->getMimeType(), $this->allowedTypes, true)) {
            $this->error = 'Invalid file type. Allowed: JPG, PNG, GIF, WEBP.';
            return null;
        }

        // Validate size
        if ($file->getSizeByUnit('kb') > $this->maxSize) {
            $this->error = 'File exceeds the maximum size of ' . ($this->maxSize / 1024) . ' MB.';
            return null;
        }

        $destination = $this->basePath . $subfolder;

        // Generate unique filename
        $newName = $file->getRandomName();

        $file->move($destination, $newName);

        // Return path relative to the public accessor
        return 'uploads/' . $subfolder . '/' . $newName;
    }

    /**
     * Delete an uploaded image.
     */
    public function delete(?string $relativePath): bool
    {
        if (empty($relativePath)) {
            return false;
        }

        $fullPath = WRITEPATH . $relativePath;

        if (is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    /**
     * Return the last error message.
     */
    public function getError(): string
    {
        return $this->error;
    }
}
