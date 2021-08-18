<?php

namespace App\Aws\Controller;

use App\Aws\Model\Resource;
use App\Facades\Log;
use App\Facades\Router;
use App\Facades\Session;
use App\Facades\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ronanchilvers\Orm\Orm;

class ResourceController
{
    /**
     * Index action
     *
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $resources = Orm::finder(Resource::class)->all();

        return View::render(
            $response,
            'resource/index.html.twig',
            [
                'resources' => $resources
            ]
        );
    }
}
