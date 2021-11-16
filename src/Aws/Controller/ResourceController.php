<?php

namespace App\Aws\Controller;

use App\Aws\Model\Account;
use App\Aws\Model\Resource;
use App\Aws\Region;
use App\Facades\Log;
use App\Facades\Router;
use App\Facades\Session;
use App\Facades\View;
use App\Model\State;
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

        $params = [
            'type'    => FILTER_SANITIZE_STRING,
            'account' => FILTER_SANITIZE_NUMBER_INT,
            'region'  => FILTER_SANITIZE_STRING,
            'state'   => FILTER_SANITIZE_STRING,
        ];
        $filters = [];
        foreach ($params as $param => $filter) {
            $value = filter_var(
                $request->getParam($param, null),
                $filter
            );
            if (!$value) {
                $value = null;
            }
            $filters[$param] = $value;
        }

        $resources = Orm::finder(Resource::class)
            ->forFilters($filters);
        $accounts = Orm::finder(Account::class)
            ->select()
            ->orderby(Account::prefix('name'))
            ->execute();

        return View::render(
            $response,
            'resource/index.html.twig',
            [
                'resources'        => $resources,
                'accounts'         => $accounts,
                'regions'          => Region::ALL,
                'filters'          => $filters,
                'state_discover'   => State::is('discover', 'active'),
            ]
        );
    }
}
