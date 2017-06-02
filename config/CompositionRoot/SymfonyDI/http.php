<?php
declare(strict_types=1);

use Http\Factory\Diactoros\ResponseFactory;
use Http\Factory\Diactoros\StreamFactory;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;
use Zend\Diactoros\ServerRequestFactory;

return function (ContainerInterface $container): void {
    $container->register(ResponseFactory::class);
    $container->register(StreamFactory::class);

    $container->setAlias(ResponseFactoryInterface::class, ResponseFactory::class);
    $container->setAlias(StreamFactoryInterface::class, StreamFactory::class);

    $container->register(ServerRequestInterface::class)
        ->setShared(true)
        ->setFactory([ServerRequestFactory::class, 'fromGlobals']);

    $container->autowire(ResponseInterface::class)
        ->setFactory([new Reference(ResponseFactoryInterface::class), 'createResponse']);
};
