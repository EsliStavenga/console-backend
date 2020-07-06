<?php

namespace App\Repository;

use App\Entity\Part;
use Doctrine\Persistence\ManagerRegistry;

class PartRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Part::class);
    }

}
