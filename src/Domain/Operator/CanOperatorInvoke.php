<?php
declare(strict_types=1);

namespace Booking\Domain\Operator;

use Closure;

trait CanOperatorInvoke
{
    /**
     * @var OperatorInterface
     */
    private $operator;

    private function invoke(string $spec): Closure
    {
        return ($this->operator)($spec);
    }
}
