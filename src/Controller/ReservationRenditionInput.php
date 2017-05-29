<?php
declare(strict_types=1);

namespace Booking\Controller;

use Booking\Controller\ReservationRendition;
use Closure;
use Psr\Http\Message\ServerRequestInterface;

final class ReservationRenditionInput
{
    public function __invoke(ServerRequestInterface $request): ReservationRendition
    {
        $fromBody = $this->getValueFromBody($request);

        return new ReservationRendition(
            $fromBody('date', 'Not a date'),
            $fromBody('name', 'Not a name'),
            $fromBody('email', 'Not a email'),
            (int) $fromBody('quantity', 0)
        );
    }

    private function getValueFromBody(ServerRequestInterface $request): Closure
    {
        $parsedBody = $request->getParsedBody();

        return function ($key, $default = null) use ($parsedBody) {
            return $parsedBody[$key] ?? $parsedBody[$key] ?? $default;
        };
    }
}
