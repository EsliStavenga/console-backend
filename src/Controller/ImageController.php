<?php

namespace App\Controller;

use App\Service\CommandService;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ImageController
 * @package App\Controller
 *
 * @Route(path="/image")
 */
class ImageController
{

	/**
	 * @var CommandService
	 */
	private CommandService $commandService;

	public function __construct(
		CommandService $commandService
	)
	{
		$this->commandService = $commandService;
	}

}