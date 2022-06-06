<?php

namespace App\Service;

use App\Entity\Event;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface MainServiceInterface
{
    public function getPaginatedList(int $page): PaginationInterface;
}