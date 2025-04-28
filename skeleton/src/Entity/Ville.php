<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?pays $pays = null;

    /**
     * @var Collection<int, Destination>
     */
    #[ORM\OneToMany(targetEntity: Destination::class, mappedBy: 'ville')]
    private Collection $destinations;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?pays
    {
        return $this->pays;
    }

    public function setPays(?pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, Destination>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination): static
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations->add($destination);
            $destination->setVille($this);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): static
    {
        if ($this->destinations->removeElement($destination)) {
            // set the owning side to null (unless already changed)
            if ($destination->getVille() === $this) {
                $destination->setVille(null);
            }
        }

        return $this;
    }
}
