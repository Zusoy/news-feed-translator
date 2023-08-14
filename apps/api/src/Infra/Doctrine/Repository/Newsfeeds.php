<?php

declare(strict_types=1);

namespace Infra\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\Newsfeed;
use Domain\Repository\Newsfeeds as NewsfeedsInterface;

final class Newsfeeds implements NewsfeedsInterface
{
    /**
     * @var \Doctrine\ORM\EntityRepository<Newsfeed>
     */
    private readonly \Doctrine\ORM\EntityRepository $innerRepository;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        $this->innerRepository = $entityManager->getRepository(Newsfeed::class);
    }

    public function add(Newsfeed $newsfeed)
    {
        $this->entityManager->persist($newsfeed);
        $this->entityManager->flush();
    }

    public function findAll(): iterable
    {
        return $this->innerRepository->findBy(
            criteria: [],
            orderBy: ['writtenAt' => 'DESC']
        );
    }

    public function findByProviderId(int $providerId): ?Newsfeed
    {
        return $this->innerRepository->findOneBy(['providerId' => $providerId]);
    }

    public function findLastRecordId(): ?int
    {
        $lastRecord = $this->innerRepository->findOneBy(criteria: [], orderBy: ['providerRecordId' => 'DESC']);

        return $lastRecord ? $lastRecord->getProviderId() : null;
    }
}
