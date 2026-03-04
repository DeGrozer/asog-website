<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// Models
use App\Models\PostModel;
use App\Models\IncubateeApplicationModel;
use App\Models\AdminModel;

// Libraries
use App\Libraries\ImageUpload;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    // Preload Models
    protected $postModel;
    protected $applicationModel;
    protected $adminModel;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Instantiate models
        $this->postModel        = new PostModel();
        $this->applicationModel = new IncubateeApplicationModel();
        $this->adminModel       = new AdminModel();
    }
}
