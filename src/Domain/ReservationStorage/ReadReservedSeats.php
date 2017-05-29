<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationStorage;

use DateTimeImmutable;

interface ReadReservedSeats
{
    public function __invoke(DateTimeImmutable $dateTime): int;
}
