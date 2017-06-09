<?php
declare(strict_types=1);

namespace Booking\Domain\Operator;

use Booking\Domain\Operator\OperatorInterface;
use Closure;

final class LazyOperator implements OperatorInterface
{
    public function __construct(callable $invoke)
    {
        $this->invoke = $invoke;
    }

    public function __invoke(string $spec): Closure
    {
        return function (...$args) use ($spec) {
            return ($this->invoke)($spec, $args);
        };
    }

    /**
     * @var callable
     */
    private $invoke;
}
