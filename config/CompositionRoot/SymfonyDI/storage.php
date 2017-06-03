<?php
declare(strict_types=1);

use Booking\Domain\ReservationStorage\{
    ReadReservedSeats,
    SaveReservation
};
use Booking\Storage\Reservation\{
    PdoReadReservedSeats,
    PdoSaveReservation
};
use Symfony\Component\DependencyInjection\ContainerInterface;

return function (ContainerInterface $container): void {
    $container->autowire(PdoReadReservedSeats::class);
    $container->autowire(PdoSaveReservation::class);

    $container->setAlias(ReadReservedSeats::class, PdoReadReservedSeats::class);
    $container->setAlias(SaveReservation::class, PdoSaveReservation::class);
};
