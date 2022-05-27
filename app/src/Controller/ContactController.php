<?php
/**
 * Record controller.
 */

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecordController.
 */
#[Route('/contact')]
class ContactController extends AbstractController {
    /**
     * Index action.
     *
     * @param ContactRepository $repository Record repository
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'contact_index',
        methods: 'GET'
    )]
    public function index(Request $request, ContactRepository $contactRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $contactRepository->queryAll(),
            $request->query->getInt('page', 1),
            ContactRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('contact/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param ContactRepository $repository Record repository
     * @param int              $id         Record id
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'contact_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(ContactRepository $repository, int $id): Response
    {
        $contact = $repository->findOneById($id);

        return $this->render(
            'contact/edit.html.twig',
            ['contact' => $contact]
        );
    }
}

