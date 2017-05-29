<?php
declare(strict_types=1);

use Auryn\Injector;
use Booking\Infrastructure\ContractorInterface;

final class AurynResolver implements ContractorInterface
{
    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    public function __invoke(string $spec)
    {
        return $this->injector->make($spec);
    }

    /**
     * @var Injector
     */
    private $injector;
}
