<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Controller\ReservationController;
use FastRoute\{
    Dispatcher,
    RouteCollector
};
use function FastRoute\cachedDispatcher;

return function (Injector $injector): void {
    $dispatcherFactory = static function () {
        $router = function (RouteCollector $route): void {
            $route->post('/reservations', ReservationController::class);
        };

        $options = [
            'cacheFile' => getenv('ROUTE_CACHE_FILE'),
            'cacheDisabled' => getenv('ROUTE_CACHE') === false,
        ];

        return cachedDispatcher($router, $options);
    };

    $injector->delegate(Dispatcher::class, $dispatcherFactory);
};
