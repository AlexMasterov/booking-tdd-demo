<?php
declare(strict_types=1);

namespace Booking\Domain;

use Booking\Domain\Result\Failure;
use Booking\Domain\Result\Success;

abstract class Result
{
    final public static function of($x): Result
    {
        return self::success($x);
    }

    final public static function success($x): Success
    {
        return new Success($x);
    }

    final public static function failure($x): Failure
    {
        return new Failure($x);
    }

    abstract public function bind(callable $fn): Result;
    abstract public function map(callable $fn): Result;
    abstract public function isSuccess(): bool;
    abstract public function isFailure(): bool;

    protected $value = null;

    private function __construct($value)
    {
        $this->value = $value;
    }
}
