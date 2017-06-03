<?php
declare(strict_types=1);

use FastRoute\Dispatcher;
use PhpFp\Either\Either;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\DependencyInjection\{
    ContainerInterface,
    Reference
};
use function EitherWay\dispatch;

final class EitherWayDispatchFactory
{
    public static function make(
        ServerRequestInterface $request,
        Dispatcher $dispatcher
    ): Either {
        return dispatch($request, $dispatcher);
    }
}

return function (ContainerInterface $container): void {
    $container->register('EitherWay\dispatch')
        ->setFactory([EitherWayDispatchFactory::class, 'make'])
        ->setArguments([
            new Reference(ServerRequestInterface::class),
            new Reference(Dispatcher::class),
        ]);
};
