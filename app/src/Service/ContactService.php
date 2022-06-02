<?php

namespace App\Service;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class ContactService implements ContactServiceInterface {
    private ContactRepository $contactRepository;

    private PaginatorInterface $paginator;

    public function __construct(ContactRepository $contactRepository, PaginatorInterface $paginator) {
        $this->contactRepository = $contactRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface {
        return $this->paginator->paginate(
            $this->contactRepository->queryAll(),
            $page,
            ContactRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Contact $contact Contact entity
     */
    public function save(Contact $contact): void
    {
        $this->contactRepository->save($contact);
    }

    /**
     * Delete entity.
     *
     * @param Contact $contact Contact entity
     */
    public function delete(Contact $contact): void
    {
        $this->contactRepository->delete($contact);
    }
}