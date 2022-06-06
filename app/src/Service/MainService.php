<?php

namespace App\Service;

use App\Entity\Event;
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

    public function getPaginatedList(int $page): PaginationInterface
    {

        return $this->paginator->paginate(
            $this->eventRepository->queryCurrent(),
            $page,
            EventRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}