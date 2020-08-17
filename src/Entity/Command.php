<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Overblog\GraphQLBundle\Annotation as GQL;
use App\Repository\CommandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 * @GQL\Type
 */
class Command extends BaseEntity implements ICommand
{

	/**
	 * @ORM\Column(type="string", length=255, unique=true)
	 * @GQL\Field(type="String!")
	 */
	private string $name;

	/**
	 * @var String[]
	 */
	private array $args;

	/**
	 * @ORM\OneToMany(targetEntity=Response::class, mappedBy="command", orphanRemoval=true, cascade={"persist"})
	 * @var Response[]
	 */
	private Collection $responses;

	public function __construct()
	{
		$this->responses = new ArrayCollection();
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getResponse(): Response
	{
		return $this->responses->get(0);
	}

	public function setArgs(array $args)
	{
		$this->args = $args;
	}

	/**
	 * @return Collection|Response[]
	 */
	public function getResponses(): Collection
	{
		return $this->responses;
	}

	public function addResponse(Response $response): self
	{
		if (!$this->responses->contains($response)) {
			$this->responses[] = $response;
			$response->setCommand($this);
		}

		return $this;
	}

	public function removeResponse(Response $response): self
	{
		if ($this->responses->contains($response)) {
			$this->responses->removeElement($response);
			// set the owning side to null (unless already changed)
			if ($response->getCommand() === $this) {
				$response->setCommand(null);
			}
		}

		return $this;
	}
}
