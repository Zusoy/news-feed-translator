<?php

declare(strict_types=1);

namespace Application\HTTP\Controller;

use Domain\Command\Newsfeed as Command;
use Infra\Symfony\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/newsfeeds')]
final class Newsfeed extends BaseController
{
    #[Route(path: '/', methods: [Request::METHOD_GET])]
    public function list(): Response
    {
        $newsfeeds = $this->bus->execute(new Command\GetAll());

        return $this->createJsonResponse(
            data: $newsfeeds,
            status: Response::HTTP_OK
        );
    }
}
