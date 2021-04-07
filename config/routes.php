<?php
// Add routes here
// Variables available :
//   - $container
//   - $app

use App\Controller\IndexController;
use App\Slim\App;

$app->get(
    '/',
    IndexController::class . ':index'
);

// Accounts
$app->group('/account', function (App $app) {
    include(__DIR__ . '/routes/account.php');
});
