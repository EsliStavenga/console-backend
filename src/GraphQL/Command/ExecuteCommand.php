<?php

namespace App\GraphQL\Command;

use App\Entity\Command;
use App\Entity\Line;
use App\Entity\Part;
use App\Entity\Response;
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
	 * @var CommandService
	 */
	private CommandService $commandService;
	/**
	 * @var EntityManagerInterface
	 */
	private EntityManagerInterface $em;

	public function __construct(CommandService $commandService, EntityManagerInterface $em)
	{
		$this->commandService = $commandService;
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
		$c = $this->commandService->getCommandByName($command);


//		var_dump($c);
//
//
//		$c = new Command();
//		$c->setName('help');
//		$c->setShowInGUI(false);
//
//		$response = new Response();
//
//		$line = new Line();
//		$line->addPart((new Part())->setContent('projects')->setForegroundColor('108728')->setExecuteOnClick($this->em->getRepository(Command::class)->findOneBy(['name' => 'projects'])));
//		$line->addPart((new Part())->setContent('An overview of projects'));
//
//		$response->addResponseLine($line);
//
//		$c->addResponse($response);
//		$this->em->persist($c);
//		$this->em->flush();

		return (!empty($c) ? $c->getResponse()->setTitle($c->getName()) : null);

	}

}
