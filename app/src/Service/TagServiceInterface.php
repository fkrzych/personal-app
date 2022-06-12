<?php

namespace App\Service;

use App\Entity\Tag;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface TagServiceInterface {
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Tag $tag Tag entity
     */
    public function save(Tag $tag): void;

    /**
     * Delete entity.
     *
     * @param Tag $tag Tag entity
     */
    public function delete(Tag $tag): void;


    /**
     * Find by name.
     *
     * @param string $name Tag title
     *
     * @return Tag|null Tag entity
     */
    public function findOneByName(string $name): ?Tag;
}