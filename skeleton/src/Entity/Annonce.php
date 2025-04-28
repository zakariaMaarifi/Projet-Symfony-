<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?vendeur $vendeur = null;

    #[ORM\OneToOne(inversedBy: 'annonce', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?reservation $reservation = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEcheance = null;

    #[ORM\Column]
    private ?bool $estActive = null;

    /**
     * @var Collection<int, media>
     */
    #[ORM\OneToMany(targetEntity: media::class, mappedBy: 'annonce')]
    private Collection $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVendeur(): ?vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(?vendeur $vendeur): static
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    public function getReservation(): ?reservation
    {
        return $this->reservation;
    }

    public function setReservation(reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->dateEcheance;
    }

    public function setDateEcheance(\DateTimeInterface $dateEcheance): static
    {
        $this->dateEcheance = $dateEcheance;

        return $this;
    }

    public function isEstActive(): ?bool
    {
        return $this->estActive;
    }

    public function setEstActive(bool $estActive): static
    {
        $this->estActive = $estActive;

        return $this;
    }

    /**
     * @return Collection<int, media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(media $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setAnnonce($this);
        }

        return $this;
    }

    public function removeMedium(media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getAnnonce() === $this) {
                $medium->setAnnonce(null);
            }
        }

        return $this;
    }
}
