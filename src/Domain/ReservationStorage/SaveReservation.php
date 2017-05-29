<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationStorage;

use Booking\Domain\Reservation;

interface SaveReservation
{
    public function __invoke(Reservation $rendition): void;
}
