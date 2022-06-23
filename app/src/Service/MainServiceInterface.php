<?php
/**
 * Main service interface.
 */

namespace App\Service;

use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface MainServiceInterface.
 */
interface MainServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, User $author): PaginationInterface;
}