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
        $parsedBody = $this->parseBody($request);
        $fromBody = $this->getValueFromBody($parsedBody);

        return new ReservationRendition(
            $fromBody('date', 'Not a date'),
            $fromBody('name', 'Not a name'),
            $fromBody('email', 'Not a email'),
            (int) $fromBody('quantity', 0)
        );
    }

    private function parseBody(ServerRequestInterface $request): array
    {
        $parts = \explode(';', $request->getHeaderLine('Content-Type'));
        $type = \strtolower(\trim(\array_shift($parts)));

        if ('application/json' === $type) {
            $body = (string) $request->getBody();
            return \json_decode($body, true);
        }

        return $request->getParsedBody();
    }

    private function getValueFromBody(array $body): Closure
    {
        return function ($key, $default = null) use ($body) {
            return $body[$key] ?? $default;
        };
    }
}
