<?php

use Auryn\Injector;
use Http\Factory\Diactoros\ResponseFactory;
use Http\Factory\Diactoros\StreamFactory;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

return function (Injector $injector): void {
    $injector->share(ResponseFactoryInterface::class);
    $injector->share(StreamFactoryInterface::class);

    $injector->alias(
        ResponseFactoryInterface::class,
        ResponseFactory::class
    );

    $injector->alias(
        StreamFactoryInterface::class,
        StreamFactory::class
    );

    $injector->share(ServerRequestInterface::class);

    $injector->delegate(ServerRequestInterface::class,
        [ServerRequestFactory::class, 'fromGlobals']
    );

    $injector->delegate(ResponseInterface::class,
        [ResponseFactoryInterface::class, 'createResponse']
    );
};
