<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Domain\ReservationStorage\ReadReservedSeats;
use Booking\Domain\ReservationStorage\SaveReservation;
use Booking\Storage\Reservation\PdoReadReservedSeats;
use Booking\Storage\Reservation\PdoSaveReservation;

return function (Injector $injector): void {
    $injector->alias(
        ReadReservedSeats::class,
        PdoReadReservedSeats::class
    );

    $injector->alias(
        SaveReservation::class,
        PdoSaveReservation::class
    );
};
