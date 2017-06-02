<?php
declare(strict_types=1);

use Booking\Controller\ReservationController;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Symfony\Component\DependencyInjection\ContainerInterface;
use function FastRoute\cachedDispatcher;

final class FastRouteDispatcherFactory
{
    public static function make(): Dispatcher
    {
        $router = function (RouteCollector $route): void {
            $route->post('/reservations', ReservationController::class);
        };

        $options = [
            'cacheFile' => getenv('ROUTE_CACHE_FILE'),
            'cacheDisabled' => getenv('ROUTE_CACHE') === false,
        ];

        return cachedDispatcher($router, $options);
    }
}

return function (ContainerInterface $container): void {
    $container->autowire(Dispatcher::class)
        ->setFactory([FastRouteDispatcherFactory::class, 'make']);
};
