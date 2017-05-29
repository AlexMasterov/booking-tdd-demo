<?php

use Auryn\Injector;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\ServerRequestFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Nyholm\Psr7\Factory\MessageFactory as ResponseFactory;
use Nyholm\Psr7\Factory\ServerRequestFactory;
use Nyholm\Psr7\Factory\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

return function (Injector $injector): void {
    $injector->share(ResponseFactoryInterface::class);
    $injector->share(ServerRequestFactoryInterface::class);
    $injector->share(StreamFactoryInterface::class);

    $injector->alias(ResponseFactoryInterface::class, ResponseFactory::class);
    $injector->alias(ServerRequestFactoryInterface::class, ServerRequestFactory::class);
    $injector->alias(StreamFactoryInterface::class, StreamFactory::class);

    $injector->share(ServerRequestInterface::class);

    $injector->delegate(ServerRequestInterface::class, static function (ServerRequestFactoryInterface $factory) {
        return $factory->createServerRequestFromGlobals();
    });

    $injector->delegate(ResponseInterface::class, static function (ResponseFactoryInterface $factory) {
        return $factory->createResponse();
    });
};
