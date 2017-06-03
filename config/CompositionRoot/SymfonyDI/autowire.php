<?php
declare(strict_types=1);

use Booking\Responder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\{
    ContainerInterface,
    Definition,
    Loader\PhpFileLoader
};

return function (ContainerInterface $container): void {
    $rootDir = $container->getParameterBag()->get('root_dir');
    $prototype = (new Definition)->setAutowired(true);

    $loader = new PhpFileLoader($container, new FileLocator($rootDir));

    // Controllers
    $loader->registerClasses(
        $prototype,
        'Booking\\Controller\\',
        'src/Controller/*{Controller,Input}'
    );

    $container->autowire(Responder::class);
};
