<?php
declare(strict_types=1);

namespace Booking;

final class Payload
{
    // 2xx
    public const OK = 200;
    // 4xx
    public const BAD_REQUEST = 400;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    // 5xx
    public const INTERNAL_SERVER_ERROR = 500;

    public function __construct(
        int $status,
        array $data = []
    ) {
        $this->status = $status;
        $this->data = $data;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    private $status;
    private $data;
}
