<?php
declare(strict_types=1);

namespace Booking\Controller;

final class ReservationRendition
{
    public function __construct(
        string $date,
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

    private $date;
    private $name;
    private $email;
    private $quantity;
}
