<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php"; //load files that composer generate

use Framework\App;
use App\Controllers\HomeController;

$app = new App();

$app->get('/', [HomeController::class, 'home']);

// show_r($app);

return $app;