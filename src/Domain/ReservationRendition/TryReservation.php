<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationRendition;

use Booking\Domain\ActionInterface;
use Booking\Domain\Operator\CanOperatorInvoke;
use Booking\Domain\Operator\OperatorInterface;
use Booking\Domain\Reservation;
use Booking\Domain\ReservationRendition\TryCapacityCheck;
use Booking\Domain\ReservationStorage\ReadReservedSeats;
use Booking\Domain\ReservationStorage\SaveReservation;
use Booking\Domain\ReservationValidator;
use Booking\Domain\Result;

final class TryReservation implements ActionInterface
{
    use CanOperatorInvoke;

    public function __construct(OperatorInterface $operator)
    {
        $this->operator = $operator;
    }

    public function __invoke($rendition): Result
    {
        return (new ReservationValidator)($rendition)
            ->bind(function (Reservation $reservation): Result {
                $tryCapacityCheck = $this->invoke(TryCapacityCheck::class);
                $getReservedSeats = $this->invoke(ReadReservedSeats::class);

                return $tryCapacityCheck(
                    $getReservedSeats($reservation->date),
                    $reservation
                );
            })
            ->map(function (Reservation $reservation): Reservation {
                $saveReservation = $this->invoke(SaveReservation::class);
                $saveReservation($reservation);

                return $reservation;
            });
    }
}
