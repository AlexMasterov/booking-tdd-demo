<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Controller\ReservationController;
use Booking\Domain\ReservationRendition\TryCapacityCheck;
use Booking\Domain\ReservationRendition\TryReservation;
use Booking\Domain\ReservationRendition\TryReservationRendition;

return function (Injector $injector): void {
    $injector->define(TryCapacityCheck::class, [
        ':capacity' => getenv('CAPACITY'),
    ]);

    $injector->define(ReservationController::class, [
        'tryReservation' => TryReservation::class,
    ]);
};
