<?php
declare(strict_types=1);

namespace Booking\Tests\Domain;

use Booking\Domain\{
    ActionInterface,
    Result,
    Result\Failure,
    Result\Success
};
use Exception;
use Throwable;

trait CanActionFake
{
    protected function success(): string
    {
        return Success::class;
    }

    protected function failure(): string
    {
        return Failure::class;
    }

    protected function successResult($value = null): ActionInterface
    {
        return new class($value) implements ActionInterface {
            public function __construct($value)
            {
                $this->value = $value;
            }

            public function __invoke($value): Result
            {
                return Result::success($this->value);
            }

            /**
             * @var mixed
             */
            private $value;
        };
    }

    protected function failureResult($value = null): ActionInterface
    {
        $throwable = $value ?? new Exception('Test exception message');

        return new class($throwable) implements ActionInterface {
            public function __construct(Throwable $throwable)
            {
                $this->throwable = $throwable;
            }

            public function __invoke($value): Result
            {
                return Result::failure($this->throwable);
            }

            /**
             * @var Throwable
             */
            private $throwable;
        };
    }
}
