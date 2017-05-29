<?php
declare(strict_types=1);

namespace Booking\Payload;

use Booking\Payload;

trait CanForbidden
{
    protected function forbidden(array $data = []): Payload
    {
        return new Payload(Payload::FORBIDDEN, $data);
    }
}
