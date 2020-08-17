<?php

namespace App\Service;

use App\Entity\Command;

class CommandService extends BaseService
{

	protected ?string $entityType = Command::class;

	public function getCommandByName(string $name) {
		return $this->repository->findOneBy([
			'name' => $name
		]);
	}

}