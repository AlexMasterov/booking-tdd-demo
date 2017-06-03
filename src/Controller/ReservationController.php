<?php
declare(strict_types=1);

namespace Booking\Controller;

use Booking\Controller\ReservationRendition;
use Booking\Domain\ActionInterface;
use Booking\{
    Payload,
    Payload\CanOk
};

final class ReservationController
{
    use CanOk;
    use CanReservationFailure;

    public function __construct(ActionInterface $tryReservation)
    {
        $this->tryReservation = $tryReservation;
    }

    public function post(ReservationRendition $rendition): Payload
    {
        $reservation = ($this->tryReservation)($rendition);

        if ($reservation->isFailure()) {
            return $this->failure($reservation->get());
        }

        // Success -> Reservation -> []
        $data = $reservation->get()->toArray();

        return $this->ok($data);
    }

    /**
     * @var ActionInterface
     */
    private $tryReservation;
}
