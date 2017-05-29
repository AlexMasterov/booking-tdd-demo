<?php
declare(strict_types=1);

namespace Booking\Payload;

use Booking\Payload;

trait CanOk
{
    protected function ok(array $data = []): Payload
    {
        return new Payload(Payload::OK, $data);
    }
}
