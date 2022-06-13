<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class MainService implements MainServiceInterface
{
    private EventRepository $eventRepository;

    private PaginatorInterface $paginator;

    public function __construct(EventRepository $eventRepository, PaginatorInterface $paginator)
    {
        $this->eventRepository = $eventRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int  $page   Page number
     * @param User $author Author
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, User $author): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->eventRepository->queryByAuthor($author),
            $page,
            EventRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}