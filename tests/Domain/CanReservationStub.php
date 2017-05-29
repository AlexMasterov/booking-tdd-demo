<?php
declare(strict_types=1);

namespace Booking\Tests\Domain;

use Booking\Domain\Reservation;
use DateTimeImmutable;

trait CanReservationStub
{
    protected function reservation(...$args): Reservation
    {
        static $date = 'now';

        $default = [
            (new DateTimeImmutable($date)),
            'Alex Masterov',
            'alex.masterow@gmail.com',
            1,
        ];

        $values = array_values(array_replace($default, $args));

        return new Reservation(...$values);
    }
}
