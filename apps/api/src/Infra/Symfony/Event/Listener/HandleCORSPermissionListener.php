<?php

declare(strict_types=1);

namespace Infra\Symfony\Event\Listener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class HandleCORSPermissionListener
{
    public function __invoke(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $event->getResponse()->headers->add(
            [
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }
}
