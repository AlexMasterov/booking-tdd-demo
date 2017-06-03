<?php
declare(strict_types=1);

use Booking\Infrastructure\ContractorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SymfonyDIResolver implements ContractorInterface
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $spec)
    {
        return $this->container->get($spec);
    }

    /**
     * @var ContainerInterface
     */
    private $container;
}

$container = require_once __DIR__ . '/SymfonyDIContainer.php';

return new SymfonyDIResolver($container);
