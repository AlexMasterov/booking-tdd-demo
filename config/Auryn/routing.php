<?php
declare(strict_types=1);

use Auryn\Injector;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\cachedDispatcher;

return function (Injector $injector): void {
    $injector->delegate(Dispatcher::class, function () {
        return cachedDispatcher(function (RouteCollector $r) {
            $r->post('/reservations', Booking\Controller\ReservationController::class);
        }, [
            'cacheFile' => getenv('ROUTE_CACHE_FILE'),
            'cacheDisabled' => getenv('ROUTE_CACHE') === false,
        ]);
    });
};
