<?php
declare(strict_types=1);

namespace Booking\Domain;

use Booking\Domain\ReservationValidator;
use DomainException;

class ReservationValidatorException extends DomainException
{
    public const INVALID_QUANTITY = 1;
    public const INVALID_DATE = 2;

    public static function invalidQuantity(): ReservationValidatorException
    {
        $message = 'Invalid quantity';

        return new static($message, self::INVALID_QUANTITY);
    }

    public static function invalidDate(): ReservationValidatorException
    {
        $message = \sprintf(
            'Date is invalid or does not match format `%s`',
            ReservationValidator::VALID_DATE_FORMAT
        );

        return new static($message, self::INVALID_DATE);
    }
}
