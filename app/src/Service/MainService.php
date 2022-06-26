<?php
/**
 * Main service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\EventRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class MainService.
 */
class MainService implements MainServiceInterface
{
    /**
     * Event repository.
     */
    private EventRepository $eventRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param EventRepository    $eventRepository Event repository
     * @param PaginatorInterface $paginator       Paginator
     */
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
            $this->eventRepository->queryByAuthorCurrent($author),
            $page,
            EventRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    public function notification(User $author) {
        if(count($this->eventRepository->countCurrent($author))) {
            return 1;
        } else {
            return 0;
        }
    }
}
