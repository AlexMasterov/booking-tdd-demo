<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationRendition;

use DomainException;

class TryCapacityCheckException extends DomainException
{
    public const EXCEEDED_QUOTA = 1;

    public static function exceededQuota(): TryCapacityCheckException
    {
        $message = 'Exceeded quota capacity';

        return new static($message, self::EXCEEDED_QUOTA);
    }
}
