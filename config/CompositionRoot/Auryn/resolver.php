<?php
declare(strict_types=1);

use Auryn\Injector;

return function (Injector $injector): void {
    $injector->define(AurynResolver::class, [
        'injector' => Injector::class,
    ]);

    $injector->share(Injector::class);

    $injector->alias(
        ResolverInterface::class,
        AurynResolver::class
    );
};
