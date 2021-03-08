<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;
/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThan(propertyPath="dateHeureDebut", 
     * message="La date de fin ne peut pas être inférieure à la date de début")
     */
    private $dateHeureFin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="cours")
     */
    private $professeur;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="cours")
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="cours")
     */
    private $salle;

    public function __toString()
    {
        return sprintf('%s', $this->type);
    }

    public function jsonSerialize()
    {
      return [
        'id' => $this->id,
        'type' => $this->type,
        'dateHeureDebut' => $this->dateHeureDebut,
        'dateHeureFin' => $this->dateHeureFin,
        'professeur' => $this->professeur,
        'matiere' => $this->matiere,
        'salle' => $this->salle,
      ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->dateHeureFin;
    }

    public function setDateHeureFin(\DateTimeInterface $dateHeureFin): self
    {
        $this->dateHeureFin = $dateHeureFin;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
