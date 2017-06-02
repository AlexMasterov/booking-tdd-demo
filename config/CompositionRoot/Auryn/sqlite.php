<?php
declare(strict_types=1);

use Auryn\Injector;

return function (Injector $injector): void {
    static $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_PERSISTENT         => true,
    ];

    $database = \getenv('SQLITE_DATABASE') ?: 'memory';

    if (strtolower($database) === 'memory') {
        $database = ":{$database}:";
    }

    $dsn = "sqlite:{$database}";

    $injector->define(PDO::class, [
        ':dsn'     => $dsn,
        ':options' => $options,
    ]);
};
