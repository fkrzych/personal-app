<?php

    namespace App\Service;

    use App\Entity\Event;
    use App\Repository\EventRepository;
    use Knp\Component\Pager\Pagination\PaginationInterface;
    use Knp\Component\Pager\PaginatorInterface;

    class EventService implements EventServiceInterface {
        private EventRepository $eventRepository;

        private PaginatorInterface $paginator;

        public function __construct(EventRepository $eventRepository, PaginatorInterface $paginator) {
            $this->eventRepository = $eventRepository;
            $this->paginator = $paginator;
        }

        public function getPaginatedList(int $page): PaginationInterface {
            return $this->paginator->paginate(
                $this->eventRepository->queryAll(),
                $page,
                EventRepository::PAGINATOR_ITEMS_PER_PAGE
            );
        }

        /**
         * Save entity.
         *
         * @param Event $event Event entity
         */
        public function save(Event $event): void
        {
            $this->eventRepository->save($event);
        }

        /**
         * Delete entity.
         *
         * @param Event $event Event entity
         */
        public function delete(Event $event): void
        {
            $this->eventRepository->delete($event);
        }

    }