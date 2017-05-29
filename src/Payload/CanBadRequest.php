<?php
declare(strict_types=1);

namespace Booking\Payload;

use Booking\Payload;

trait CanBadRequest
{
    protected function badRequest(array $data = []): Payload
    {
        return new Payload(Payload::BAD_REQUEST, $data);
    }
}
