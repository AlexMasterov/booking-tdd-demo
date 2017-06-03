<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationRendition;

use Booking\Domain\{
    ActionInterface,
    Operator\CanOperatorInvoke,
    Operator\OperatorInterface,
    Reservation,
    ReservationRendition\TryCapacityCheck,
    ReservationStorage\ReadReservedSeats,
    ReservationStorage\SaveReservation,
    ReservationValidator,
    Result
};

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
