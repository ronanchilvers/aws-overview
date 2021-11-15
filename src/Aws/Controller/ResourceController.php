<?php

namespace App\Aws\Controller;

use App\Aws\Model\Account;
use App\Aws\Model\Resource;
use App\Aws\Region;
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

        $type    = filter_var(
            $request->getParam('type', null),
            FILTER_SANITIZE_STRING
        );
        $account = filter_var(
            $request->getParam('account', null),
            FILTER_SANITIZE_NUMBER_INT
        );
        $region  = filter_var(
            $request->getParam('region', null),
            FILTER_SANITIZE_STRING
        );
        $resources = Orm::finder(Resource::class)
            ->forFilters($type, $account, $region);
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
                'filtered_type'    => $type,
                'filtered_account' => $account,
                'filtered_region'  => $region,
            ]
        );
    }
}
