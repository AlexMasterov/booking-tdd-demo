<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerInterface;

return function (ContainerInterface $container): void {
    static $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_PERSISTENT         => true,
    ];

    $database = \getenv('SQLITE_DATABASE') ?: 'memory';

    if (\strtolower($database) === 'memory') {
        $database = ":{$database}:";
    }

    $dsn = "sqlite:{$database}";

    $container->register(PDO::class, PDO::class)
        ->setShared(true)
        ->setArguments([$dsn, null /* username */, null /* passwd */, $options]);
};
