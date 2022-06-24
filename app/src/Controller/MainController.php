<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Repository\EventRepository;
use App\Service\MainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class MainController.
 */
#[Route('/main')]
class MainController extends AbstractController
{
    /**
     * Main service.
     */
    private MainServiceInterface $mainService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    public function __construct(MainServiceInterface $mainService, TranslatorInterface $translator)
    {
        $this->mainService = $mainService;
        $this->translator = $translator;
    }

    #[Route(
        name: 'main_index',
        methods: 'GET'
    )]
    public function index(Request $request): Response
    {
        $pagination = $this->mainService->getPaginatedList(
            $request->query->getInt('page', 1),
            $this->getUser()
        );

        return $this->render('main/index.html.twig', ['pagination' => $pagination]);
    }

    #[Route(
        '/{id}',
        name: 'main_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(EventRepository $repository, int $id): Response
    {
        $event = $repository->findOneById($id);

        return $this->render(
            'event/show.html.twig',
            ['event' => $event]
        );
    }
}
