<?php
declare(strict_types=1);

use Booking\Domain\Operator\{
    LazyOperator,
    OperatorInterface
};
use Symfony\Component\DependencyInjection\{
    Argument\ServiceClosureArgument,
    ContainerInterface,
    Reference
};

return function (ContainerInterface $container): void {
    $container->register(LazyOperator::class)
        ->addArgument(new ServiceClosureArgument(new Reference('service_container')));

    $container->setAlias(OperatorInterface::class, LazyOperator::class);
};
