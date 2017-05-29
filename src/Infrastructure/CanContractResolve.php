<?php
declare(strict_types=1);

namespace Booking\Infrastructure;

trait CanContractResolve
{
    /**
     * @var ContractorInterface
     */
    private $resolver;

    private function resolve(string $spec)
    {
        return ($this->resolver)($spec);
    }
}
