<?php

namespace App\Service;

use App\Entity\Contact;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ContactServiceInterface {
    public function getPaginatedList(int $page): PaginationInterface;
}