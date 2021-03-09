<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JsonSerializable;
/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @UniqueEntity(
 *      fields={"professeur", "dateHeureDebut"},
 *      errorPath="dateHeureDebut",
 *      message="Ce professeur a déjà un cours prévu à cette heure-ci."
 * )
 * @UniqueEntity(
 *      fields={"salle", "dateHeureDebut"},
 *      errorPath="salle",
 *      message="Cette salle est déjà prise à cette heure-ci."
 * )
 * 
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

    /**
     * @ORM\Column(type="integer")
     */
    private $dayNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $weekNumber;


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
        'weekNumber' => $this->weekNumber,
        'dayNumber' => $this->dayNumber,
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
        $this->weekNumber = $this->getWeek();
        $this->dayNumber = $this->getDay();
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

    public function getWeek(){
      return $this->dateHeureDebut->format('W');
    }

    public function getDay(){
      return $this->dateHeureDebut->format('z');
    }

}
