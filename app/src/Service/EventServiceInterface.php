<?php

    namespace App\Service;

    use App\Entity\Event;
    use Knp\Component\Pager\Pagination\PaginationInterface;

    interface EventServiceInterface {
        public function getPaginatedList(int $page): PaginationInterface;

        /**
         * Save entity.
         *
         * @param Event $event Event entity
         */
        public function save(Event $event): void;

        /**
         * Delete entity.
         *
         * @param Event $event Event entity
         */
        public function delete(Event $event): void;
    }