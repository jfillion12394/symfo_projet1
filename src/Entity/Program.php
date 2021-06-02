<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
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
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $poster;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class,inversedBy="programs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Saison::class, mappedBy="program")
     */
    private $Saison;

    /**
     * @ORM\OneToMany(targetEntity=Saison::class, mappedBy="MaSaison")
     */
    private $saison;

    public function __construct()
    {
        $this->Saison = new ArrayCollection();
        $this->saison = new ArrayCollection();
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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getSaison(): Collection
    {
        return $this->Saison;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->Saison->contains($saison)) {
            $this->Saison[] = $saison;
            $saison->addProgram($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->Saison->removeElement($saison)) {
            $saison->removeProgram($this);
        }

        return $this;
    }
}
