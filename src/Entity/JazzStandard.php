<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class JazzStandard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $authors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interpreter;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $tempo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $track;

    public function __construct(
        string $name,
        string $authors,
        string $interpreter,
        string $tempo,
        string $track
    ) {
        $this->name = $name;
        $this->authors = explode(',', $authors);
        $this->interpreter = $interpreter;
        $this->tempo = $tempo;
        $this->track = $track;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getInterpreter(): string
    {
        return $this->interpreter;
    }

    public function getTempo(): string
    {
        return $this->tempo;
    }

    public function getTrack(): string
    {
        return $this->track;
    }
}