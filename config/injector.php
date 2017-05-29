<?php
declare(strict_types=1);

use Cairon\InjectorConfig;

return InjectorConfig::make()
    ->configure([
        require 'Auryn\resolver.php',
        require 'Auryn\operator.php',
        require 'Auryn\reservation.php',
        require 'Auryn\http.php',
        require 'Auryn\routing.php',
        require 'Auryn\sqlite.php',
        require 'Auryn\storage.php',
    ])
    ->injector();
