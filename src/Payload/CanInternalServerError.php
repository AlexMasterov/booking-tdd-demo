<?php
declare(strict_types=1);

namespace Booking\Payload;

use Booking\Payload;

trait CanInternalServerError
{
    protected function internalServerError(array $data = []): Payload
    {
        return new Payload(Payload::INTERNAL_SERVER_ERROR, $data);
    }
}
