<?php
declare(strict_types=1);

require __DIR__ . '/AurynResolver.php';

$injector = require __DIR__ . '/injector.php';

return new AurynResolver($injector);
