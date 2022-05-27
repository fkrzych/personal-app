<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/event')]
class EventController extends AbstractController {

    #[Route(
        name: 'event_index',
        methods: 'GET'
    )]
    public function index(Request $request, EventRepository $eventRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $eventRepository->queryAll(),
            $request->query->getInt('page', 1),
            EventRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('event/index.html.twig', ['pagination' => $pagination]);
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
