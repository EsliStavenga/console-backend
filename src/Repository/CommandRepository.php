<?php

namespace App\Repository;

use App\Entity\Command;
use Doctrine\Persistence\ManagerRegistry;

class CommandRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Command::class);
    }


}
