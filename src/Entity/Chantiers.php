<?php

namespace App\Entity;

use App\Repository\ChantiersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChantiersRepository::class)]
class Chantiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePrincipale = null;

    //Doctrine propose un type spécial json qui :
    //permet de stocker des tableaux/objets encodés en JSON, 
    // gère automatiquement l'encodage/décodage, 
    // n’a pas de limite arbitraire comme 255 caractères
    #[ORM\Column(type: Types::JSON)]
    private array $carrouselImages = [];

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePrincipale(): ?string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(string $imagePrincipale): static
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    public function getCarrouselImages(): array
    {
        return $this->carrouselImages;
    }

    public function setCarrouselImages(array $carrouselImages): self
    {
        $this->carrouselImages = $carrouselImages;
        return $this;
    }

}
