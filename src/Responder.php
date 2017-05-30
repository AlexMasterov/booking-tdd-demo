<?php
declare(strict_types=1);

namespace Booking;

use Booking\Payload;
use Interop\Http\Factory\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;

final class Responder
{
    public function __construct(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(
        ResponseInterface $response,
        Payload $payload
    ): ResponseInterface {
        if ($this->hasData($payload)) {
            $response = $this->format($response, $payload);
        }

        $response = $response
            ->withStatus($payload->status)
            ->withHeader('Content-Type', 'application/json');

        return $response;
    }

    public function format(
        ResponseInterface $response,
        Payload $payload
    ): ResponseInterface {
        $content = \json_encode($payload->data);
        $stream = $this->streamFactory->createStream($content);

        return $response->withBody($stream);
    }

    private function hasData(Payload $payload): bool
    {
        // empty() still does not work correctly with magic __get
        return false === empty($data = $payload->data);
    }

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
}
