<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController {

    #[Route(
        name: 'event_index',
        methods: 'GET'
    )]
    public function index(EventRepository $repository): Response {
        $events = $repository->findAll();

        return $this->render(
            'event/index.html.twig',
            ['events' => $events]
        );
    }

    #[Route(
        '/{id}',
        name: 'event_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(EventRepository $repository, int $id): Response {
        $event = $repository->findOneById($id);

        return $this->render(
            'event/edit.html.twig',
            ['event' => $event]
        );
    }
}
