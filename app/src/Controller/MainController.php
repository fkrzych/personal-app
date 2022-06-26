<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Repository\EventRepository;
use App\Service\MainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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

    /**
     * Constructor.
     */
    public function __construct(MainServiceInterface $mainService, TranslatorInterface $translator)
    {
        $this->mainService = $mainService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
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

    /**
     * Show action.
     *
     * @param EventRepository $repository Record repository
     * @param int $id Record id
     *
     * @return Response HTTP response
     */
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

    /**
     * Email action.
     *
     * @throws TransportExceptionInterface
     */
    #[Route('/email', name: 'main_email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($this->getUser()->getEmail())
            ->subject($this->translator->trans('message.current_events'))
            ->text($this->translator->trans('message.hello').' '.$this->getUser()->getEmail().'!'.PHP_EOL.PHP_EOL.$this->translator->trans('message.remember_about_events'))
        ;

        if ($this->mainService->ifCurrentsExist($this->getUser())) {
            $mailer->send($email);

            $this->addFlash(
                'success',
                $this->translator->trans('message.email_sent')
            );
        } else {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.email_not_sent')
            );
        }
        
        return $this->redirectToRoute('main_index');
    }
}
