<?php

use Booking\Responder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

$rootDir = \dirname(__DIR__, 2);

$parameters = new ParameterBag([
    'rootDir' => $rootDir,
]);

$container = new ContainerBuilder($parameters);

$configs = [
    require 'SymfonyDI\reservation.php',
    require 'SymfonyDI\operator.php',
    require 'SymfonyDI\http.php',
    require 'SymfonyDI\routing.php',
    require 'SymfonyDI\dispatch.php',
    require 'SymfonyDI\sqlite.php',
    require 'SymfonyDI\storage.php',
];

$apply = function ($config) use ($container): void {
    $config($container);
};

\array_map($apply, $configs);

$container->autowire(Responder::class);
$container->compile();

return $container;
