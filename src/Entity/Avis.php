<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClient = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?int $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): static
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        if ($note < 1 || $note > 5) {
            throw new \InvalidArgumentException('La note doit être comprise entre 1 et 5.');
        }

        $this->note = $note;

        return $this;
    }

    /**
     * Retourne le HTML avec les étoiles (sur 5)
     */
    public function getEtoilesHtml(): string
    {
        $etoiles = min(5, max(0, $this->note));
        $html = '';

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $etoiles) {
                $html .= '<span class="fas fa-star text-primary"></span>';
            } else {
                $html .= '<span class="far fa-star text-secondary"></span>';
            }
        }

        return $html;
    }
}
