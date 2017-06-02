<?php
declare(strict_types=1);

use Booking\Domain\ReservationStorage\ReadReservedSeats;
use Booking\Domain\ReservationStorage\SaveReservation;
use Booking\Storage\Reservation\PdoReadReservedSeats;
use Booking\Storage\Reservation\PdoSaveReservation;
use Symfony\Component\DependencyInjection\ContainerInterface;

return function (ContainerInterface $container): void {
    $container->autowire(PdoReadReservedSeats::class);
    $container->autowire(PdoSaveReservation::class);

    $container->setAlias(ReadReservedSeats::class, PdoReadReservedSeats::class);
    $container->setAlias(SaveReservation::class, PdoSaveReservation::class);
};
