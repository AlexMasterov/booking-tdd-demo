<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\{
    ContainerBuilder,
    ParameterBag\ParameterBag
};

$rootDir = \dirname(__DIR__, 2);

$parameters = new ParameterBag([
    'root_dir' => $rootDir,
]);

$container = new ContainerBuilder($parameters);

$configs = [
    require 'SymfonyDI\autowire.php',
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

$container->compile();

return $container;
