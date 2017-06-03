<?php
declare(strict_types=1);

namespace Booking\Domain\ReservationRendition;

use Booking\Domain\{
    Reservation,
    ReservationRendition\TryCapacityCheckException,
    Result
};

final class TryCapacityCheck
{
    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
    }

    public function __invoke(
        int $reservedSeats,
        Reservation $reservation
    ): Result {
        $reservations = $reservedSeats + $reservation->quantity;

        if ($reservations > $this->capacity) {
            return Result::failure(TryCapacityCheckException::exceededQuota());
        }

        return Result::success($reservation);
    }

    /**
     * @var int
     */
    private $capacity;
}
