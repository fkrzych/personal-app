<?php

namespace App\Service;

use App\Entity\Contact;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ContactServiceInterface {
    public function getPaginatedList(int $page, User $author, array $filters = []): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Contact $contact Contact entity
     */
    public function save(Contact $contact): void;

    /**
     * Delete entity.
     *
     * @param Contact $contact Contact entity
     */
    public function delete(Contact $contact): void;
}