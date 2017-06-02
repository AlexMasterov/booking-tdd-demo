<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Domain\Operator\LazyOperator;
use Booking\Domain\Operator\OperatorInterface;

return function (Injector $injector): void {
    $injector->define(LazyOperator::class, [
        ':invoke' => [$injector, 'execute'],
    ]);

    $injector->share(OperatorInterface::class);

    $injector->alias(
        OperatorInterface::class,
        LazyOperator::class
    );
};
