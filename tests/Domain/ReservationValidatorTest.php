<?php
declare(strict_types=1);

namespace Booking\Tests\Domain;

use Booking\Controller\ReservationRendition;
use Booking\Domain\Reservation;
use Booking\Domain\ReservationValidator;
use Booking\Domain\ReservationValidatorException;
use Booking\Tests\Domain\CanActionFake;
use PHPUnit\Framework\TestCase;

class ReservationValidatorTest extends TestCase
{
    use CanActionFake;

    public function renditionWithValidData(): array
    {
        return [
            [rendition(dates('now'), 'Alex Masterov', 'alex.masterow@gmail.com', 1)],
            [rendition(dates('+1 day'), 'Alex Masterov', 'alex.masterow@gmail.com', 1)],
        ];
    }

    /**
     * @dataProvider renditionWithValidData
     */
    public function testReturnsSuccessWhenRenditionIsValid($rendition): void
    {
        // Execute
        $result = (new ReservationValidator)($rendition);

        // Verify
        self::assertInstanceOf($this->success(), $result);
        self::assertInstanceOf(Reservation::class, $result->get());
    }

    public function renditionWithInvalidDate(): array
    {
        return [
            [rendition(dates('-1 hour'), 'Alex Masterov', 'alex.masterow@gmail.com', 1)],
            [rendition(dates('-1 day'), 'Alex Masterov', 'alex.masterow@gmail.com', 1)],
            [rendition(dates('+1 hour', 'Y-m-d H:i'), 'Alex Masterov', 'alex.masterow@gmail.com', 1)],
        ];
    }

    /**
     * @dataProvider renditionWithInvalidDate
     */
    public function testReturnsFailureWhenRenditionHasInvalidDate($rendition): void
    {
        // Execute
        $result = (new ReservationValidator)($rendition);

        // Verify
        self::assertInstanceOf($this->failure(), $result);

        $throwable = $result->get();

        self::assertEquals(ReservationValidatorException::invalidDate(), $throwable);
        self::assertSame(ReservationValidatorException::INVALID_DATE, $throwable->getCode());
    }

    public function renditionWithInvalidQuantity(): array
    {
        return [
            [rendition(dates('+1 hour'), 'Alex Masterov', 'alex.masterow@gmail.com', 0)],
            [rendition(dates('+1 day'), 'Alex Masterov', 'alex.masterow@gmail.com', -1)],
        ];
    }

    /**
     * @dataProvider renditionWithInvalidQuantity
     */
    public function testReturnsFailureWhenRenditionHasInvalidQuantity($rendition): void
    {
        // Execute
        $result = (new ReservationValidator)($rendition);

        // Verify
        self::assertInstanceOf($this->failure(), $result);

        $throwable = $result->get();

        self::assertEquals(ReservationValidatorException::invalidQuantity(), $throwable);
        self::assertSame(ReservationValidatorException::INVALID_QUANTITY, $throwable->getCode());
    }
}

function rendition(...$args): ReservationRendition
{
    return new ReservationRendition(...$args);
}

function dates(string $time, string $format = 'Y-m-d H:i:s'): string
{
    return (new \DateTimeImmutable($time))->format($format);
}
