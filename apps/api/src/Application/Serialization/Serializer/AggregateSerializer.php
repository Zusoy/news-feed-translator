<?php

declare(strict_types=1);

namespace Application\Serialization\Serializer;

use Application\Serialization\Serializer;
use Assert\Assert;
use InvalidArgumentException;

final class AggregateSerializer implements Serializer
{
    /**
     * @param iterable<Serializer> $serializers
     */
    public function __construct(private readonly iterable $serializers)
    {
        Assert::thatAll($serializers)->isInstanceOf(Serializer::class);
    }

    /**
     * {@inheritDoc}
     */
    public function supports(mixed $data, string $format): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(mixed $data, string $format): mixed
    {
        foreach ($this->serializers as $serializer) {
            if ($serializer->supports($data, $format)) {
                return $serializer->serialize($data, $format);
            }
        }

        throw new InvalidArgumentException('Serializer not found');
    }
}
