<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Verifies that a user is logged in before allowing access to protected routes.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if session exists and admin_id is set
        if (!session()->has('admin_id')) {
            return redirect()->to('/asog-admin');
        }

        return null;
    }

    /**
     * After request processing.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
