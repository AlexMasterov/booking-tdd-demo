<?php
declare(strict_types=1);

namespace Booking\Domain\Operator;

use Closure;

interface OperatorInterface
{
    public function __invoke(string $spec): Closure;
}
