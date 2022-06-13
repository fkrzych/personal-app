<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\Type\EventType;
use App\Repository\EventRepository;
use App\Service\EventService;
use App\Service\EventServiceInterface;
use App\Service\MainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/main')]
class MainController extends AbstractController
{

    private MainServiceInterface $mainService;

    /**
     * Translator.
     *
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;

    public function __construct(MainServiceInterface $mainService, TranslatorInterface $translator) {
        $this->mainService = $mainService;
        $this->translator = $translator;
    }

    #[Route(
        name: 'main_index',
        methods: 'GET'
    )]
    public function index(Request $request, EventRepository $eventRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $this->mainService->getPaginatedList(
            $request->query->getInt('page', 1),
            $this->getUser()
        );

        return $this->render('main/index.html.twig', ['pagination' => $pagination]);
    }
}
