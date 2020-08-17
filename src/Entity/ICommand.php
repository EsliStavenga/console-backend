<?php

namespace App\Entity;

interface ICommand
{

	public function getResponse(): Response;

}