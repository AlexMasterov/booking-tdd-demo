<?php
declare(strict_types=1);

namespace Booking\Domain;

use Booking\Domain\Result;

interface ActionInterface
{
    public function __invoke($value): Result;
}
