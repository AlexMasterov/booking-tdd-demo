<?php
declare(strict_types=1);

use Booking\Responder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

return function (ContainerInterface $container): void {
    $rootDir = $container->getParameterBag()->get('rootDir');
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
