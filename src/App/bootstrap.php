<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\{Routes, MiddlewareRegistrator};
use App\Config\Paths;

$app = new App(Paths::SOURCE . "/App/container-definitions.php");

//Register Controller. HomeController::class - 'App\Controllers\HomeController', 'home' - method of HomeController class
Routes::registerRoutes($app);
MiddlewareRegistrator::registerMiddleware($app);

return $app;
