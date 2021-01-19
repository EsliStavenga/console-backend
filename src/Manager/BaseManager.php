<?php

namespace App\Manager;

use App\Entity\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use InvalidArgumentException;
use PHPUnit\Runner\Exception;

abstract class BaseManager
{

	protected ?string $entityType = null;

	/**
	 * @var EntityManagerInterface
	 */
	private EntityManagerInterface $em;

	/**
	 * @var ObjectRepository
	 */
	protected ObjectRepository $repository;

	/**
	 * BaseController constructor.
	 * If you set the $entityType property, the entity's repository will automatically be set
	 *
	 * @param EntityManagerInterface $em
	 */
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;

		if ($this->entityType !== null) {
			$this->repository = $em->getRepository($this->entityType);
		}
	}

	public function getOneById(int $id)
	{
		return $this->repository->find($id);
	}

	protected function createEntity(Entity $entity): bool
	{
		$this->validateRequest($entity);

		return $this->repository->create($entity);
	}

	public function index(): ?array {
		return $this->repository->findAll();
	}

	/**
	 * @param Entity $entity
	 * @return mixed
	 */
	protected function updateEntity(Entity $entity): bool
	{
		return $this->createEntity($entity);
	}

	public function delete(?Entity $entity): bool
	{
		if($entity === null) {
			return false;
		}

		$this->validateRequest($entity);

		try {
			$this->em->remove($entity);
			$this->em->flush();

			return true;
		} catch(Exception $e) {
			return false;
		}
	}

	private function validateRequest(Entity $entity): void
	{

		if(!$entity instanceof $this->entityType) {
			throw new InvalidArgumentException("Entities may only be deleted through their own EntityManager");
		}

	}

}
