<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Overblog\GraphQLBundle\Annotation as GQL;
use App\Repository\PartRepository;

/**
 * @ORM\Entity(repositoryClass=PartRepository::class)
 * @GQL\Type
 */
class Part extends Entity
{

	/**
	 * @ORM\ManyToOne(targetEntity="Response", inversedBy="Part")
	 *
	 * @var Response The response this part is a part of *padum tssk*
	 */
	private Response $response;

	/**
	 * @ORM\Column(name="content", type="string", nullable=false)
	 * @GQL\Field(type="String")
	 * @var string The text inside this part of the response
	 */
	private string $content;

	/**
	 * @ORM\Column(name="foreground_color", type="string", nullable=false, length=6)
	 * @GQL\Field(type="String")
	 * @var string A hex string representation of the foreground color
	 */
	private string $foregroundColor = "FFFFFF";

	/**
	 * @ORM\ManyToOne(targetEntity="Command", inversedBy="parts")
	 * @ORM\JoinColumn(name="command_to_execute_on_click", nullable=true)
	 * @GQL\Field(type="Command")
	 * @var Command|null If clicked on this part of the string, execute this command. Helpful with e.g. a help command
	 */
	private ?Command $executeOnClick;

	/**
	 * @ORM\ManyToOne(targetEntity=Line::class, inversedBy="parts")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $line;

	/**
	 * @return Response
	 */
	public function getResponse(): Response
	{
		return $this->response;
	}

	/**
	 * @param Response $response
	 */
	public function setResponse(Response $response): self
	{
		$this->response = $response;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent(string $content): self
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * @return Command|null
	 */
	public function getExecuteOnClick(): ?Command
	{
		return $this->executeOnClick;
	}

	/**
	 * @param Command|null $executeOnClick
	 */
	public function setExecuteOnClick(?Command $executeOnClick): self
	{
		$this->executeOnClick = $executeOnClick;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getForegroundColor(): string
	{
		return $this->foregroundColor;
	}

	/**
	 * @param string $foregroundColor
	 */
	public function setForegroundColor(string $foregroundColor): self
	{
		$this->foregroundColor = ltrim($foregroundColor, '#');

		return $this;
	}

	public function getLine(): ?Line
	{
		return $this->line;
	}

	public function setLine(?Line $line): self
	{
		$this->line = $line;

		return $this;
	}

}
