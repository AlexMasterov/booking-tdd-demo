<?php
declare(strict_types=1);

namespace Booking\Payload;

use Booking\Payload;

trait CanNotFound
{
    protected function notFound(array $data = []): Payload
    {
        return new Payload(Payload::NOT_FOUND, $data);
    }
}
