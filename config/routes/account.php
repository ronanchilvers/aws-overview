<?php

use App\Aws\Controller\AccountController;

// Routes for AWS account management
$app->get('', AccountController::class . ':index')->setName('account.index');
$app->map(["GET", "POST"], '/add', AccountController::class . ':add')->setName('account.add');
$app->map(["GET", "POST"], '/edit/{id}', AccountController::class . ':edit')->setName('account.edit');
$app->map(["GET", "POST"], '/queue-discover/{id}', AccountController::class . ':queueDiscover')->setName('account.queue.discover');
