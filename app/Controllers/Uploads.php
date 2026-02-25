<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Serves uploaded files from `writable/uploads/` so they can be
 * displayed on the public site via `/uploads/subfolder/filename`.
 */
class Uploads extends Controller
{
    public function serve(string ...$segments)
    {
        $relativePath = implode(DIRECTORY_SEPARATOR, $segments);
        $fullPath     = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $relativePath;

        if (! is_file($fullPath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mime = mime_content_type($fullPath);

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($fullPath));
    }
}
