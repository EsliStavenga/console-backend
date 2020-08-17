<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class BaseService
{

	protected ?string $entityType = null;

	/**
	 * @var EntityManagerInterface
	 */
	protected EntityManagerInterface $em;

	protected ObjectRepository $repository;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;

		if($this->entityType !== null) {
			$this->repository = $em->getRepository($this->entityType);
		}
	}

}