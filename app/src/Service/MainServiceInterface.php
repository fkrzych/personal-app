<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface MainServiceInterface
{
    public function getPaginatedList(int $page, User $author): PaginationInterface;
}