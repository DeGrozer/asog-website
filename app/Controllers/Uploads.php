<?php

namespace App\Controllers;

/**
 * Serves uploaded files from `writable/uploads/applications/` so they can be
 * displayed on the public site via `/uploads/applications/filename`.
 *
 * Post images live in `public/uploads/posts/` and are served directly
 * by the web server — they do NOT go through this controller.
 */
class Uploads extends BaseController
{
    public function serve(string ...$segments)
    {
        $relativePath = 'applications' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $segments);
        $fullPath     = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $relativePath;

        if (! is_file($fullPath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Guess MIME from extension using CI's Mimes config
        $ext  = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $mime = \Config\Mimes::guessTypeFromExtension($ext) ?? 'application/octet-stream';

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($fullPath));
    }
}
