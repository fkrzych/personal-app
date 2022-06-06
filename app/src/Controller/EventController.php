<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\Type\EventType;
use App\Repository\EventRepository;
use App\Service\EventService;
use App\Service\EventServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


#[Route('/event')]
class EventController extends AbstractController {

    private EventServiceInterface $eventService;

    /**
     * Translator.
     *
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;

    public function __construct(EventServiceInterface $eventService, TranslatorInterface $translator) {
        $this->eventService = $eventService;
        $this->translator = $translator;
    }

    #[Route(
        name: 'event_index',
        methods: 'GET'
    )]
    public function index(Request $request, EventRepository $eventRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $this->eventService->getPaginatedList(
            $request->query->getInt('page', 1)
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
            'event/show.html.twig',
            ['event' => $event]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route(
        '/create',
        name: 'event_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request): Response
    {
        $category = new Event();
        $form = $this->createForm(EventType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventService->save($category);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render(
            'event/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Event $event Event entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'event_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event, [
            'method' => 'PUT',
            'action' => $this->generateUrl('event_edit', ['id' => $event->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventService->save($event);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render(
            'event/edit.html.twig',
            [
                'form' => $form->createView(),
                'event' => $event,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request  HTTP request
     * @param Event $event entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/delete', name: 'event_delete', requirements: ['id' => '[1-9]\d*'], methods: 'GET|DELETE')]
    public function delete(Request $request,Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('event_delete', ['id' => $event->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventService->delete($event);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render(
            'event/delete.html.twig',
            [
                'form' => $form->createView(),
                'event' => $event,
            ]
        );
    }

}
