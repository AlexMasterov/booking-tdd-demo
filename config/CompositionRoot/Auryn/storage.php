<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Domain\ReservationStorage\{
    ReadReservedSeats,
    SaveReservation
};
use Booking\Storage\Reservation\{
    PdoReadReservedSeats,
    PdoSaveReservation
};

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
