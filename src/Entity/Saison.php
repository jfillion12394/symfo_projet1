<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaisonRepository::class)
 */
class Saison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, inversedBy="Saison")
     */
    private $program;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="saison")
     */
    private $MaSaison;

    /**
     * @ORM\ManyToOne(targetEntity=Episode::class, inversedBy="season_id")
     */
    private $season_id;

    /**
     * @ORM\OneToMany(targetEntity=Episode::class, mappedBy="saison")
     */
    private $feuilleton;

    public function __construct()
    {
        $this->program = new ArrayCollection();
        $this->feuilleton = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->program->contains($program)) {
            $this->program[] = $program;
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        $this->program->removeElement($program);

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaSaison(): ?Program
    {
        return $this->MaSaison;
    }

    public function setMaSaison(?Program $MaSaison): self
    {
        $this->MaSaison = $MaSaison;

        return $this;
    }

    public function getSeasonId(): ?Episode
    {
        return $this->season_id;
    }

    public function setSeasonId(?Episode $season_id): self
    {
        $this->season_id = $season_id;

        return $this;
    }

    /**
     * @return Collection|Episode[]
     */
    public function getFeuilleton(): Collection
    {
        return $this->feuilleton;
    }

    public function addFeuilleton(Episode $feuilleton): self
    {
        if (!$this->feuilleton->contains($feuilleton)) {
            $this->feuilleton[] = $feuilleton;
            $feuilleton->setSaison($this);
        }

        return $this;
    }

    public function removeFeuilleton(Episode $feuilleton): self
    {
        if ($this->feuilleton->removeElement($feuilleton)) {
            // set the owning side to null (unless already changed)
            if ($feuilleton->getSaison() === $this) {
                $feuilleton->setSaison(null);
            }
        }

        return $this;
    }
}
