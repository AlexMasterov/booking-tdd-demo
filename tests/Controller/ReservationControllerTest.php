<?php
declare(strict_types=1);

namespace Booking\Tests\Controller;

use Booking\Controller\{
    ReservationController,
    ReservationRendition
};
use Booking\Domain\{
  Reservation,
  ReservationRendition\TryCapacityCheckException,
  ReservationValidator,
  ReservationValidatorException
};
use Booking\Payload;
use Booking\Tests\Controller\CanReservationRenditionStub;
use Booking\Tests\Domain\{
    CanActionFake,
    CanReservationStub
};
use Exception;
use PHPUnit\Framework\TestCase;

class ReservationControllerTest extends TestCase
{
    use CanActionFake;
    use CanReservationStub;
    use CanReservationRenditionStub;

    public function testReturnsSuccess(): void
    {
        // Stub
        $reservation = $this->reservation();
        $impure = $this->successResult($reservation);
        $rendition = $this->reservationRendition();

        // Execute
        $controller = new ReservationController($impure);
        $payload = $controller->post($rendition);

        // Verify
        self::assertInstanceOf(Payload::class, $payload);
        self::assertSame(Payload::OK, $payload->status);
    }

    public function failureWithError(): array
    {
        return [
            [ReservationValidatorException::invalidQuantity(), Payload::BAD_REQUEST],
            [ReservationValidatorException::invalidDate(), Payload::BAD_REQUEST],
            [TryCapacityCheckException::exceededQuota(), Payload::FORBIDDEN],
            [new Exception('Something went wrong.'), Payload::INTERNAL_SERVER_ERROR],
        ];
    }

    /**
     * @dataProvider failureWithError
     */
    public function testReturnsFailure($error, $status): void
    {
        // Stub
        $impure = $this->failureResult($error);
        $reservation = $this->reservationRendition();

        // Execute
        $controller = new ReservationController($impure);
        $payload = $controller->post($reservation);

        self::assertInstanceOf(Payload::class, $payload);
        self::assertSame($status, $payload->status);
    }
}
