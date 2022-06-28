<?php
/**
 * Contact service interface.
 */

namespace App\Service;

use App\Entity\Contact;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface ContactServiceInterface.
 */
interface ContactServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int   $page    Page number
     * @param User  $author
     * @param array $filters
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, User $author, array $filters = []): PaginationInterface;

    /**
     * Get paginated list for search.
     *
     * @param int    $page    Page number
     * @param User   $author  Author
     * @param string $pattern
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedListSearch(int $page, User $author, string $pattern): PaginationInterface;

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

    /**
     * Prepare pattern.
     *
     * @param string $pattern
     *
     * @return string Result pattern
     */
    public function preparePattern(string $pattern): string;
}
