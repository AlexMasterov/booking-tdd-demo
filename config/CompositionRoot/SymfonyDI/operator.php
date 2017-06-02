<?php
declare(strict_types=1);

use Booking\Domain\Operator\OperatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class DumbOperator implements OperatorInterface
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $spec): Closure
    {
        return function (...$args) use ($spec) {
            $executable = $this->container->get($spec);

            if (\method_exists($executable, '__invoke')) {
                return ($executable)(...$args);
            }

            return $executable;
        };
    }
}

return function (ContainerInterface $container): void {
    $container->autowire(DumbOperator::class, DumbOperator::class)
        ->setShared(true);

    $container->setAlias(OperatorInterface::class, DumbOperator::class);
};
