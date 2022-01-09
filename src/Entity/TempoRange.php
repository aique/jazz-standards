<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TempoRangeRepository::class)
 */
class TempoRange
{
    const BALLAD = 'Ballad';
    const MEDIUM = 'Medium';
    const UP = 'Up';

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
     * @ORM\Column(type="smallint")
     */
    private $start;

    /**
     * @ORM\Column(type="smallint", nullable="true")
     */
    private $end;

    public function __construct(
        string $name,
        int $start,
        ?int $end = null
    ) {
        $this->name = $name;
        $this->start = $start;
        $this->end = $end;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getEnd(): ?int
    {
        return $this->end;
    }
    
    public function intoRange(int $tempo): bool
    {
        return $this->start <= $tempo && ($this->end > $tempo || empty($this->end));
    }
}