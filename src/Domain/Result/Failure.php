<?php
declare(strict_types=1);

namespace Booking\Domain\Result;

use Booking\Domain\Result;
use Throwable;

final class Failure extends Result
{
    public function bind(callable $fn): Result
    {
        return $this;
    }

    public function map(callable $fn): Result
    {
        return $this;
    }

    public function get()
    {
        return $this->throwable;
    }

    public function isSuccess(): bool
    {
        return false;
    }

    public function isFailure(): bool
    {
        return true;
    }

    /**
     * @var Throwable
     */
    protected $throwable = null;

    protected function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }
}
