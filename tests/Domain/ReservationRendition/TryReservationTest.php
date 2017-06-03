<?php
declare(strict_types=1);

namespace Booking\Tests\Domain\ReservationRendition;

use Booking\Domain\{
    Reservation,
    ReservationRendition\TryCapacityCheck,
    ReservationRendition\TryReservation,
    ReservationStorage\ReadReservedSeats,
    ReservationStorage\SaveReservation
};
use Booking\Tests\Controller\CanReservationRenditionStub;
use Booking\Tests\Domain\{
    CanActionFake,
    Operator\CanInvokeFake
};
use PHPUnit\Framework\TestCase;
use Throwable;

class TryReservationTest extends TestCase
{
    use CanActionFake;
    use CanInvokeFake;
    use CanReservationRenditionStub;

    public function testReservationCheckReturnsSuccess(): void
    {
        // Stub
        $callable = [
            TryCapacityCheck::class => new TryCapacityCheck(10),
            ReadReservedSeats::class => 3,
            SaveReservation::class => 0,
        ];

        $rendition = $this->reservationRendition();

        // Execute
        $operator = $this->operator($callable);
        $tryReservation = new TryReservation($operator);
        $result = $tryReservation($rendition);

        // Verify
        self::assertInstanceOf($this->success(), $result);
        self::assertInstanceOf(Reservation::class, $result->get());
    }

    public function testReservationCheckReturnsFailure(): void
    {
        // Stub
        $callable = [
            TryCapacityCheck::class => new TryCapacityCheck(10),
            ReadReservedSeats::class => 20,
            SaveReservation::class => 0,
        ];

        $rendition = $this->reservationRendition();

        // Execute
        $operator = $this->operator($callable);
        $tryReservation = new TryReservation($operator);
        $result = $tryReservation($rendition);

        // Verify
        self::assertInstanceOf($this->failure(), $result);
        self::assertInstanceOf(Throwable::class, $result->get());
    }
}
