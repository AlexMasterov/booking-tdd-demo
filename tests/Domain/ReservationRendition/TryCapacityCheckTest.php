<?php
declare(strict_types=1);

namespace Booking\Tests\Domain\ReservationRendition;

use Booking\Domain\ReservationRendition\{
  TryCapacityCheck,
  TryCapacityCheckException
};
use Booking\Tests\Domain\{
    CanActionFake,
    CanReservationStub
};
use PHPUnit\Framework\TestCase;

class TryCapacityCheckTest extends TestCase
{
    use CanActionFake;
    use CanReservationStub;

    public function testReturnsSuccess(): void
    {
        // Stub
        $capacity = 10;
        $reservedSeats = 0;
        $reservation = $this->reservation();

        // Execute
        $tryCapacityCheck = new TryCapacityCheck($capacity);
        $result = $tryCapacityCheck($reservedSeats, $reservation);

        // Verify
        self::assertInstanceOf($this->success(), $result);
        self::assertSame($reservation, $result->get());
    }

    public function testReturnsFailure(): void
    {
        // Stub
        $capacity = 10;
        $reservedSeats = 11;
        $reservation = $this->reservation();

        // Execute
        $tryCapacityCheck = new TryCapacityCheck($capacity);
        $result = $tryCapacityCheck($reservedSeats, $reservation);

        // Verify
        self::assertInstanceOf($this->failure(), $result);

        $throwable = $result->get();

        self::assertEquals(
            TryCapacityCheckException::exceededQuota(),
            $throwable
        );
        self::assertSame(
            TryCapacityCheckException::EXCEEDED_QUOTA,
            $throwable->getCode()
        );
    }
}
