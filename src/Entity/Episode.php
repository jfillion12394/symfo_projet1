<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EpisodeRepository::class)
 */
class Episode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    /**
     * @ORM\OneToMany(targetEntity=Saison::class, mappedBy="season_id")
     */
    private $season_id;

    /**
     * @ORM\ManyToOne(targetEntity=Saison::class, inversedBy="feuilleton")
     */
    private $saison;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="Episode")
     */
    private $Program;

    public function __construct()
    {
        $this->season_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getSeasonId(): Collection
    {
        return $this->season_id;
    }

    public function addSeasonId(Saison $seasonId): self
    {
        if (!$this->season_id->contains($seasonId)) {
            $this->season_id[] = $seasonId;
            $seasonId->setSeasonId($this);
        }

        return $this;
    }

    public function removeSeasonId(Saison $seasonId): self
    {
        if ($this->season_id->removeElement($seasonId)) {
            // set the owning side to null (unless already changed)
            if ($seasonId->getSeasonId() === $this) {
                $seasonId->setSeasonId(null);
            }
        }

        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->Program;
    }

    public function setProgram(?Program $Program): self
    {
        $this->Program = $Program;

        return $this;
    }
}
