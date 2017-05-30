<?php

use Auryn\Injector;
use Http\Factory\Diactoros\ResponseFactory;
use Http\Factory\Diactoros\StreamFactory;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\ServerRequestFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

return function (Injector $injector): void {
    $injector->share(ResponseFactoryInterface::class);
    $injector->share(ServerRequestFactoryInterface::class);
    $injector->share(StreamFactoryInterface::class);

    $injector->alias(ResponseFactoryInterface::class, ResponseFactory::class);
    $injector->alias(ServerRequestFactoryInterface::class, ServerRequestFactory::class);
    $injector->alias(StreamFactoryInterface::class, StreamFactory::class);

    $injector->share(ServerRequestInterface::class);

    $injector->delegate(
        ServerRequestInterface::class,
        [ServerRequestFactory::class, 'fromGlobals']
    );

    $injector->delegate(ResponseInterface::class, static function (ResponseFactoryInterface $factory) {
        return $factory->createResponse();
    });
};
