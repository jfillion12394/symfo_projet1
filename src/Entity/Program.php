<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 * @ORM\Entity
 * @UniqueEntity("title")
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
     * @Assert\NotBlank(message="Titre ne peut pas être vide!!")
     * @Assert\Length(max="255", maxMessage="Le nom de série saisie {{ value }} est trop long, il ne devrait pas dépasser {{ limit }} caractères")
          * @Assert\Regex(
     *     pattern="/Plus belle la vie/",
     *     match=false,
     *     message="On parle de vraie série ici!"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de renseigner obligatoirement un  résumé de la série.")
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

    /**
     * @ORM\OneToMany(targetEntity=Episode::class, mappedBy="Program")
     */
    private $Episode;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, mappedBy="programs")
     */
    private $actors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Slug;

    public function __construct()
    {
        $this->Saison = new ArrayCollection();
        $this->saison = new ArrayCollection();
        $this->Episode = new ArrayCollection();
        $this->actors = new ArrayCollection();
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

    /**
     * @return Collection|Episode[]
     */
    public function getEpisode(): Collection
    {
        return $this->Episode;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->Episode->contains($episode)) {
            $this->Episode[] = $episode;
            $episode->setProgram($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->Episode->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getProgram() === $this) {
                $episode->setProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addProgram($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeProgram($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }
}
