<?php
declare(strict_types=1);

namespace Booking\Domain;

use DateTimeImmutable;

final class Reservation
{
    public function __construct(
        DateTimeImmutable $date,
        string $name,
        string $email,
        int $quantity
    ) {
        $this->date = $date;
        $this->name = $name;
        $this->email = $email;
        $this->quantity = $quantity;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function toArray(): array
    {
        static $dateFormat = 'Y-m-d H:i:s';

        $copy = clone $this;
        $copy->date = $copy->date->format($dateFormat);

        return \get_object_vars($copy);
    }

    private $date;
    private $name;
    private $email;
    private $quantity;
}
