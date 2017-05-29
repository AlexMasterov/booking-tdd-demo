<?php
declare(strict_types=1);

namespace Booking\Tests\Controller;

use Booking\Controller\ReservationRendition;
use DateTimeImmutable;

trait CanReservationRenditionStub
{
    protected function reservationRendition(...$args): ReservationRendition
    {
        static $date = 'now';
        static $dateFormat = 'Y-m-d H:i:s';

        $default = [
            (new DateTimeImmutable($date))->format($dateFormat),
            'Alex Masterov',
            'alex.masterow@gmail.com',
            1,
        ];

        $values = array_values(array_replace($default, $args));

        return new ReservationRendition(...$values);
    }
}
