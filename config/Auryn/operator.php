<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Domain\Operator\LazyOperator;
use Booking\Domain\Operator\OperatorInterface;

return function (Injector $injector): void {
    $invoke = [$injector, 'execute'];
    $injector->define(LazyOperator::class, [
        ':invoke' => $invoke,
    ]);

    $injector->alias(
        OperatorInterface::class,
        LazyOperator::class
    );

    $injector->share(OperatorInterface::class);
};
