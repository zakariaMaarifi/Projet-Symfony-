<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?destination $destination = null;

    /**
     * @var Collection<int, vendeur>
     */
    #[ORM\ManyToMany(targetEntity: vendeur::class, inversedBy: 'etablissements')]
    private Collection $vendeurs;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'etablissement')]
    private Collection $reservations;

    public function __construct()
    {
        $this->vendeurs = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDestination(): ?destination
    {
        return $this->destination;
    }

    public function setDestination(?destination $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return Collection<int, vendeur>
     */
    public function getVendeurs(): Collection
    {
        return $this->vendeurs;
    }

    public function addVendeur(vendeur $vendeur): static
    {
        if (!$this->vendeurs->contains($vendeur)) {
            $this->vendeurs->add($vendeur);
        }

        return $this;
    }

    public function removeVendeur(vendeur $vendeur): static
    {
        $this->vendeurs->removeElement($vendeur);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setEtablissement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEtablissement() === $this) {
                $reservation->setEtablissement(null);
            }
        }

        return $this;
    }
}
