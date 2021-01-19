<?php


namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Overblog\GraphQLBundle\Annotation as GQL;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ResponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponseRepository::class)
 * @GQL\Type
 */
class Response extends Entity
{
    /**
     * @ORM\ManyToOne(targetEntity=Command::class, inversedBy="responses")
	 * @GQL\Field(type="Command!")
     * @ORM\JoinColumn(nullable=false)
     */
    private $command;

	/**
	 * @var string
	 * @GQL\Field(type="String!")
	 */
    private string $title = '';

    /**
     * @ORM\OneToMany(targetEntity=Line::class, mappedBy="response", orphanRemoval=true, cascade={"persist"})
	 * @GQL\Field(type="[Line!]")
	 * @var Line[]
     */
    private Collection $responseLines;

    public function __construct()
    {
        $this->responseLines = new ArrayCollection();
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Collection|Line[]
     */
    public function getResponseLines(): Collection
    {
        return $this->responseLines;
    }

    public function addResponseLine(Line $responseLine): self
    {
        if (!$this->responseLines->contains($responseLine)) {
            $this->responseLines[] = $responseLine;
            $responseLine->setResponse($this);
        }

        return $this;
    }

    public function removeResponseLine(Line $responseLine): self
    {
        if ($this->responseLines->contains($responseLine)) {
            $this->responseLines->removeElement($responseLine);
            // set the owning side to null (unless already changed)
            if ($responseLine->getResponse() === $this) {
                $responseLine->setResponse(null);
            }
        }

        return $this;
    }

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): self
	{
		$this->title = $title;

		return $this;
	}
}
