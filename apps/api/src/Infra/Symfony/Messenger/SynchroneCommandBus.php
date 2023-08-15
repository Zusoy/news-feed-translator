<?php

declare(strict_types=1);

namespace Infra\Symfony\Messenger;

use Application\CommandBus as CommandBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class SynchroneCommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(object $command): mixed
    {
        try {
            return $this->handle($command);
        } catch (HandlerFailedException $error) {
            $previousError = $error->getPrevious();
            throw $previousError ?: $error;
        }
    }
}
