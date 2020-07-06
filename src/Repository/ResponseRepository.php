<?php

namespace App\Repository;


use App\Entity\Response;
use Doctrine\Persistence\ManagerRegistry;

class ResponseRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Response::class);
    }

}
