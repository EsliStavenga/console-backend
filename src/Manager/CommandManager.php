<?php

namespace App\Manager;

use App\Entity\Command;

class CommandManager extends BaseManager
{

	protected ?string $entityType = Command::class;

	public function getCommandByName(string $name)
	{
		return $this->repository->findOneBy([
			'name' => $name
		]);
	}


}
