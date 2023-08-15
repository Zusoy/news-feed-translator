<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Application\CommandBus;
use Application\Normalization\Normalizer;
use Application\Serialization\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    /**
     * @param Normalizer<mixed> $normalizer
     */
    public function __construct(
        protected readonly CommandBus $bus,
        private readonly Normalizer $normalizer,
        private readonly Serializer $serializer
    ) {
    }

    final protected function createJsonResponse(
        mixed $data = null,
        int $status = Response::HTTP_OK
    ): JsonResponse {
        $data = $this->normalizer->normalize($data);

        $response = new JsonResponse(
            data: $this->serializer->serialize($data, format: Serializer::JSON_FORMAT),
            status: $status,
            json: true
        );

        if (is_countable($data)) {
            $response->headers->add([
                'X-Total-Count' => count($data),
            ]);
        }

        return $response;
    }
}
