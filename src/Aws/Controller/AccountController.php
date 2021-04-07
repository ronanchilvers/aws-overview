<?php

namespace App\Aws\Controller;

use App\Aws\Model\Account;
use App\Aws\Region;
use App\Facades\Log;
use App\Facades\Router;
use App\Facades\Session;
use App\Facades\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ronanchilvers\Orm\Orm;

class AccountController
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

        $accounts = Orm::finder(Account::class)->all();

        return View::render(
            $response,
            'account/index.html.twig',
            [
                'accounts' => $accounts
            ]
        );
    }

    /**
     * Add an account
     *
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function add(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $account = new Account();

        if ($request->isMethod("POST")) {
            $data = $request->getParsedBody()['data'];
            $account->fromArray($data);
            $account->regions = array_values($data['regions']);
            if ($account->saveWithValidation()) {
                Session::flash([
                    'heading' => 'Account added'
                ], 'success');
                return $response->withRedirect(
                    Router::pathFor('account.index')
                    // Router::pathFor('project.view', ['key' => $account->key])
                );
            }
            Session::flash([
                'heading' => 'Failed to add account'
            ], 'error');
            Log::debug('Account add failed', [
                'errors' => $account->getErrors()
            ]);
        }
        $regions = $account->regions;
        if (empty($regions)) {
            $account->regions = Region::DEFAULT;
        }

        return View::render(
            $response,
            'account/add.html.twig',
            [
                'account' => $account,
                'regions' => Region::ALL
            ]
        );
    }

    /**
     * Edit an account
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function edit(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {
        if (!isset($args['id'])) {
            Session::flash([
                'heading' => 'Invalid or missing account id'
            ], 'error');
            return $response->withRedirect(
                Router::pathFor('account.index')
            );
        }
        $account = Orm::finder(Account::class)->one($args['id']);
        if ($request->isMethod("POST")) {
            $data = $request->getParsedBody()['data'];
            $account->fromArray($data);
            $account->regions = array_values($data['regions']);
            if ($account->saveWithValidation()) {
                Session::flash([
                    'heading' => 'Account updated'
                ], 'success');
                return $response->withRedirect(
                    Router::pathFor('account.edit', [ 'id' => $account->id ])
                );
            }
            Session::flash([
                'heading' => 'Failed to update account'
            ], 'error');
            Log::debug('Account update failed', [
                'errors' => $account->getErrors()
            ]);
        }


        return View::render(
            $response,
            'account/edit.html.twig',
            [
                'account' => $account,
                'regions' => Region::ALL
            ]
        );
    }
}
