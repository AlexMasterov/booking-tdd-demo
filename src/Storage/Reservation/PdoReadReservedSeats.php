<?php
declare(strict_types=1);

namespace Booking\Storage\Reservation;

use Booking\Domain\ReservationStorage\ReadReservedSeats;
use Booking\Domain\ReservationValidator;
use Booking\Storage\Table;
use DateInterval;
use DateTimeImmutable;
use PDO;

final class PdoReadReservedSeats implements ReadReservedSeats
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function __invoke(DateTimeImmutable $dateTime): int
    {
        $maxDateTime = $this->acceptableDateTime($dateTime);

        $query = \sprintf(
            'SELECT SUM(quantity) as total FROM %s WHERE date <= "?"',
            Table::RESERVATIONS
        );

        $stmt = $this->pdo->prepare($query);
        $stmt->bindColumn(1, $maxDateTime);
        $stmt->execute();

        $found = (int) $stmt->fetchColumn();

        return $found;
    }

    /**
     * @var PDO
     */
    private $pdo;

    private function acceptableDateTime(DateTimeImmutable $dateTime): string
    {
        static $pdoDateFormat = 'Y-m-d H:i:s';

        $add = DateInterval::createFromDateString(ReservationValidator::MAX_ACCEPTABLE_DATE_TIME);

        return $dateTime->add($add)->format($pdoDateFormat);
    }
}
