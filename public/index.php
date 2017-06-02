<?php
declare(strict_types=1);

use Booking\Controller\ReservationController;
use Booking\Controller\ReservationRendition;
use Booking\Controller\ReservationRenditionInput;
use Booking\Domain\Operator\OperatorInterface;
use Booking\Payload;
use Booking\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/env.php';

$resolver = require __DIR__ . '/../config/resolver.php';

$errorHandler = function (int $status) use ($resolver): ResponseInterface {
    $response = ($resolver)(ResponseInterface::class);
    $payload = new Payload($status);

    $responder = ($resolver)(Responder::class);
    $response = $responder($response, $payload);

    return $response;
};

$successHandler = function (EitherWay\Route $route) use ($resolver): ResponseInterface {
    $request = $route->request();
    $reservation = (new ReservationRenditionInput)($request);

    $controller = ($resolver)($route->handler());
    $payload = $controller->post($reservation);

    $response = ($resolver)(ResponseInterface::class);
    $responder = ($resolver)(Responder::class);

    $response = $responder($response, $payload);

    return $response;
};

$operator = ($resolver)(OperatorInterface::class);
$response = ($operator)('EitherWay\dispatch')()->either($errorHandler, $successHandler);

Http\Response\send($response);
