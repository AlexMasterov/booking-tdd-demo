<?php
declare(strict_types=1);

use josegonzalez\Dotenv\Loader;

$rootDir = \dirname(__DIR__, 1);
$envFile = $rootDir . '/.env';

$rootFilter = function (array $data) use ($rootDir) {
    return \str_replace('__ROOT__', $rootDir, $data);
};

$loader = new Loader($envFile);
$loader
    ->parse()
    ->expect('CAPACITY')
    ->setFilters([$rootFilter])
    ->filter()
    ->putEnv(false);
