<?php
declare(strict_types=1);

use Booking\Controller\ReservationController;
use Booking\Domain\ReservationRendition\TryCapacityCheck;
use Booking\Domain\ReservationRendition\TryReservation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

return function (ContainerInterface $container): void {
    $container->register(TryCapacityCheck::class)
        ->addArgument(getenv('CAPACITY'));

    $container->autowire(TryReservation::class);

    $container->register(ReservationController::class)
        ->addArgument(new Reference(TryReservation::class));
};
