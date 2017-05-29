<?php
declare(strict_types=1);

namespace Booking\Storage\Reservation;

use Booking\Domain\Reservation;
use Booking\Domain\ReservationStorage\SaveReservation;
use Booking\Domain\ReservationValidator;
use Booking\Storage\Table;
use PDO;

final class PdoSaveReservation implements SaveReservation
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function __invoke(Reservation $rendition): void
    {
        $query = \sprintf(
            'INSERT INTO %s (date, name, email, quantity) VALUES (?, ?, ?, ?)',
            Table::RESERVATIONS
        );

        $values = \array_values($rendition->toArray());

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
    }

    /**
     * @var PDO
     */
    private $pdo;
}
