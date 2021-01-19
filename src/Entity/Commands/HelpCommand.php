<?php


namespace App\Entity\Commands;


use App\Entity\Command;
use App\Entity\Response;

class HelpCommand extends Command implements ICommand
{
	protected string $name = 'help';

	public final function __construct()
	{
		parent::__construct();
		
	}

	public final function getResponse(array $args): Response
	{

	}
}
