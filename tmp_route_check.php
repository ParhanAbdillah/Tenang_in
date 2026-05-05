<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$router = $app['router'];
$route = $router->getRoutes()->getByName('user.psychologist.index');
if ($route) {
    echo 'uri=' . $route->uri() . PHP_EOL;
    echo 'middleware=' . json_encode($route->middleware()) . PHP_EOL;
    echo 'action=' . $route->getActionName() . PHP_EOL;
} else {
    echo 'NO_ROUTE' . PHP_EOL;
}
