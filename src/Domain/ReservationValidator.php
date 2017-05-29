<?php
declare(strict_types=1);

namespace Booking\Domain;

use Booking\Controller\ReservationRendition;
use Booking\Domain\Reservation;
use Booking\Domain\ReservationValidatorException;
use Booking\Domain\Result;
use DateTimeImmutable;

final class ReservationValidator
{
    public const MIN_ACCEPTABLE_QUANTITY = 1;
    public const MIN_ACCEPTABLE_DATE_TIME = '-5 minutes';
    public const MAX_ACCEPTABLE_DATE_TIME = '+1 day';

    public const VALID_DATE_FORMAT = 'Y-m-d H:i:s';

    public function __invoke(ReservationRendition $rendition): Result
    {
        if (false === $this->isValidQuantity($rendition)) {
            return Result::failure(ReservationValidatorException::invalidQuantity());
        }

        $renditionDateTime = $this->parseDate($rendition);

        if (false === $this->isValidDateTime($renditionDateTime)) {
            return Result::failure(ReservationValidatorException::invalidDate());
        }

        return Result::success(
            new Reservation(
                $renditionDateTime,
                $rendition->name,
                $rendition->email,
                $rendition->quantity
            )
        );
    }

    private function parseDate(ReservationRendition $rendition)
    {
        return DateTimeImmutable::createFromFormat(self::VALID_DATE_FORMAT, $rendition->date);
    }

    private function isValidQuantity(ReservationRendition $rendition): bool
    {
        return $rendition->quantity >= self::MIN_ACCEPTABLE_QUANTITY;
    }

    private function isValidDateTime($renditionDateTime): bool
    {
        $minAcceptableDateTime = new DateTimeImmutable(self::MIN_ACCEPTABLE_DATE_TIME);

        return $renditionDateTime instanceof DateTimeImmutable
            && $renditionDateTime > $minAcceptableDateTime;
    }
}
