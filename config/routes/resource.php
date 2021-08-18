<?php

use App\Aws\Controller\ResourceController;

// Routes for AWS resource management
$app->get('', ResourceController::class . ':index')->setName('resource.index');
