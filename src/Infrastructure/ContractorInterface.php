<?php
declare(strict_types=1);

namespace Booking\Infrastructure;

interface ContractorInterface
{
    /**
     * Resolve a class spec into an object.
     *
     * @return object
     */
    public function __invoke(string $spec);
}
