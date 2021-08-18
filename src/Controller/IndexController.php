<?php

namespace App\Controller;

use App\Facades\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Controller for the index
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class IndexController
{
    /**
     * Index action
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        return $response->withRedirect(
            Router::pathFor('resource.index')
        );
    }
}
