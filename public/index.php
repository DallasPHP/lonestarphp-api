<?php
require '../vendor/autoload.php';

use \Aura\Sql\ExtendedPdo;
use \Monolog\Logger;
use \Lonestar\View\Json;

define('APP_PATH', dirname(__DIR__));
Dotenv::load(APP_PATH);

// Prepare app
$app = New \SlimController\Slim(array(
    'controller.class_prefix'    => '\\Lonestar\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
));


// Create monolog logger and store logger in container as singleton
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new Logger('api-lonestarphp');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

$app->container->singleton('db', function() {
    return new ExtendedPdo(
        "mysql:host={$_SERVER['PHINX_API_LONESTARPHP_DB_HOST']};dbname={$_SERVER['PHINX_API_LONESTARPHP_DB_NAME']}",
        $_SERVER['PHINX_API_LONESTARPHP_DB_USER'],
        $_SERVER['PHINX_API_LONESTARPHP_DB_PASSWORD']
    );
});

$app->view(new Json);

// GET Routes
$app->addRoutes([
    '/speakers' => ['get' => 'Speaker:index'],
    '/speakers/:id' => ['get' => 'Speaker:show'],
    '/speakers/:id/talks' => ['get' => 'Speaker:talks'],
    '/talks' => ['get' => 'Talk:index'],
    '/talks/:id' => ['get' => 'Talk:show'],
    '/talks/:id/speaker' => ['get' => 'Talk:speaker'],
    '/sponsors' => ['get' => 'Sponsor:index'],
    '/sponsors/:id' => ['get' => 'Sponsor:show'],
]);

// POST Routes
$app->addRoutes([
    '/speakers' => ['post' => 'Speaker:create'],
]);

// Error Routes
$app->notFound(function() use ($app) {
    $app->render(404, ['message' => 'Page Could Not Found']);
});
$app->error(function(\Exception $e) use ($app) {
    $app->render(500, ['message' => $e->getMessage()]);
});

// Run app
$app->run();
