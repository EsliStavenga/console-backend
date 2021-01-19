<?php

namespace App\Entity\Commands;

use App\Entity\Response;

interface ICommand
{

	public function getResponse(array $args): Response;

}
