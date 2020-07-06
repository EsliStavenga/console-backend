<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Overblog\GraphQLBundle\Annotation as GQL;
use App\Repository\CommandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 * @GQL\Type
 */
class Command extends BaseEntity
{

    /**
     * @ORM\Column(type="string", length=255)
     * @GQL\Field(type="String!")
     */
    private string $name;

    /**
     * @ORM\OneToOne(targetEntity="Response", mappedBy="command")
     * @GQL\Field(type="Response!")
     */
    private Response $response;


    /**
     *
     * @ORM\OneToMany(targetEntity="Part", mappedBy="executeOnClick")
     * @var ArrayCollection All the parts that will execute this command on click
     */
    private ArrayCollection $parts;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): self
    {
        $this->response = $response;

        return $this;
    }

	/**
	 * @return ArrayCollection
	 */
	public function getParts(): ArrayCollection
	{
		return $this->parts;
	}

	/**
	 * @param ArrayCollection $parts
	 */
	public function setParts(ArrayCollection $parts): void
	{
		$this->parts = $parts;
	}
}
