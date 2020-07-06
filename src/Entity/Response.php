<?php


namespace App\Entity;

use Overblog\GraphQLBundle\Annotation as GQL;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ResponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponseRepository::class)
 * @GQL\Type
 */
class Response extends BaseEntity
{

    /**
     * @ORM\OneToOne(targetEntity="Command", inversedBy="response")
     * @var Command
     */
    private Command $command;

    /**
     * @ORM\OneToMany(targetEntity="Part", mappedBy="response")
     *
     * @GQL\Field(type="[Part!]")
     * @var ArrayCollection
     */
    private ArrayCollection $parts;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
    }

	/**
	 * @return Command
	 */
	public function getCommand(): Command
	{
		return $this->command;
	}

	/**
	 * @param Command $command
	 */
	public function setCommand(Command $command): void
	{
		$this->command = $command;
	}

}