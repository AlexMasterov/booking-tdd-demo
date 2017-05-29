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
        $body = \json_encode($payload->data);
        $stream = $this->streamFactory->createStream($body);

        $response = $response
            ->withBody($stream)
            ->withStatus($payload->status)
            ->withHeader('Content-Type', 'application/json')
            ;

        return $response;
    }

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
}
