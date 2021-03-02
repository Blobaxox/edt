<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfesseurRepository::class)
 */
class Professeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string",unique=true,length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy=professeur)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Avis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
      $this->nom = $nom;
      return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom): self
    {
      $this->prenom = $prenom;
      return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
      $this->email = $email;
      return $this;
    }

}
