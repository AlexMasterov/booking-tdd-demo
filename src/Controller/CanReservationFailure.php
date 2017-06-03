<?php
declare(strict_types=1);

namespace Booking\Controller;

use Booking\Domain\{
    ReservationRendition\TryCapacityCheckException,
    ReservationValidatorException
};
use Booking\{
    Payload,
    Payload\CanBadRequest,
    Payload\CanForbidden,
    Payload\CanInternalServerError
};
use Throwable;

trait CanReservationFailure
{
    use CanBadRequest;
    use CanForbidden;
    use CanInternalServerError;

    protected function failure(Throwable $throwable): Payload
    {
        $data['message'] = $throwable->getMessage();

        if ($throwable instanceof ReservationValidatorException) {
            return $this->badRequest($data);
        }

        if ($throwable instanceof TryCapacityCheckException) {
            return $this->forbidden($data);
        }

        return $this->internalServerError($data);
    }
}
