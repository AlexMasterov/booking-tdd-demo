<?php
declare(strict_types=1);

use Auryn\Injector;

return function (Injector $injector): void {
    $injector->define(AurynResolver::class, [
        ':injector' => $injector,
    ]);

    $injector->share(Injector::class);

    $injector->alias(
        ResolverInterface::class,
        AurynResolver::class
    );
};
