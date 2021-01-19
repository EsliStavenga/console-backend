<?php

namespace App\GraphQL\Command;

use App\Entity\Command;
use App\Entity\Line;
use App\Entity\Part;
use App\Entity\Response;
use App\Manager\CommandManager;
use App\Service\CommandService;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * Class ExecuteCommand
 * @package App\GraphQL\Command
 * @GQL\Provider()
 */
class ExecuteCommand
{

	/**
	 * @var CommandManager
	 */
	private CommandManager $commandManager;
	/**
	 * @var EntityManagerInterface
	 */
	private EntityManagerInterface $em;

	public function __construct(CommandManager $commandManager, EntityManagerInterface $em)
	{
		$this->commandManager = $commandManager;
		$this->em = $em;
	}

	/**
	 *
	 * @GQL\Query(type="Response", name="executeCommand", args={
	 *	  @GQL\Arg(name="command", type="String!", description="The command to execute"),
	 *	  @GQL\Arg(name="arguments", type="[String]", description="The arguments for this command")
	 *     })
	 *
	 * @param string $command
	 * @param array|null $args
	 * @return Response
	 */
	public function executeCommand(string $command, ?array $args) {
		/** @var Command|null $c */
		$c = $this->commandManager->getCommandByName($command);

		return (!empty($c) ? $c->getResponse($args ?? [])->setTitle($c->getName()) : null);

	}

}
