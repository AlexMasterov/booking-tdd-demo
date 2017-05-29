<?php
declare(strict_types=1);

namespace Booking\Tests\Domain\Operator;

use Booking\Domain\Operator\OperatorInterface;
use Closure;

trait CanInvokeFake
{
    protected function operator(array $stub = []): OperatorInterface
    {
        return new class($stub) implements OperatorInterface {
            public function __construct(array $stub = [])
            {
                $this->stub = $stub;
            }

            public function __invoke(string $spec): Closure
            {
                $value = $this->stub[$spec] ?? null;
                return function (...$args) use ($value) {
                    return \is_callable($value) ? $value(...$args) : $value;
                };
            }

            /**
             * @var array
             */
            private $stub = [];
        };
    }
}
