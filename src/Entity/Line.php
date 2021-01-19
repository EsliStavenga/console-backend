<?php

namespace App\Entity;

use App\Repository\LineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @ORM\Entity(repositoryClass=LineRepository::class)
 * @GQL\Type
 */
class Line extends Entity
{
    /**
     * @ORM\OneToMany(targetEntity=Part::class, mappedBy="line", orphanRemoval=true, cascade={"persist"})
	 * @GQL\Field(type="[Part!]")
     */
    private $parts;

    /**
     * @ORM\ManyToOne(targetEntity=Response::class, inversedBy="responseLines")
     * @ORM\JoinColumn(nullable=false)
	 * @GQL\Field(type="Response")
     */
    private $response;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Part[]
     */
    public function getParts(): Collection
    {
        return $this->parts;
    }

    public function addPart(Part $part): self
    {
        if (!$this->parts->contains($part)) {
            $this->parts[] = $part;
            $part->setLine($this);
        }

        return $this;
    }

    public function removePart(Part $part): self
    {
        if ($this->parts->contains($part)) {
            $this->parts->removeElement($part);
            // set the owning side to null (unless already changed)
            if ($part->getLine() === $this) {
                $part->setLine(null);
            }
        }

        return $this;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(?Response $response): self
    {
        $this->response = $response;

        return $this;
    }
}
