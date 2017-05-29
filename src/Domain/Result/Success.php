<?php
declare(strict_types=1);

namespace Booking\Domain\Result;

use Booking\Domain\Result;
use Throwable;

final class Success extends Result
{
    public function bind(callable $fn): Result
    {
        try {
            return $fn($this->value);
        } catch (Throwable $throwable) {
            return Result::failure($throwable);
        }
    }

    public function map(callable $fn): Result
    {
        try {
            return Result::success($fn($this->value));
        } catch (Throwable $throwable) {
            return Result::failure($throwable);
        }
    }

    public function get()
    {
        return $this->value;
    }

    public function isSuccess(): bool
    {
        return true;
    }

    public function isFailure(): bool
    {
        return false;
    }
}
