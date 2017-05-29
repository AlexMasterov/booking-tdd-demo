<?php
declare(strict_types=1);

namespace Booking\Controller;

use Booking\Domain\ReservationRendition\TryCapacityCheckException;
use Booking\Domain\ReservationValidatorException;
use Booking\Payload;
use Booking\Payload\CanBadRequest;
use Booking\Payload\CanForbidden;
use Booking\Payload\CanInternalServerError;
use Throwable;

trait CanReservationFailure
{
    use CanBadRequest;
    use CanForbidden;
    use CanInternalServerError;

    protected function failure(Throwable $throwable): Payload
    {
        $message = $throwable->getMessage();

        if ($throwable instanceof ReservationValidatorException) {
            return $this->badRequest(compact('message'));
        }

        if ($throwable instanceof TryCapacityCheckException) {
            return $this->forbidden(compact('message'));
        }

        return $this->internalServerError(compact('message'));
    }
}
