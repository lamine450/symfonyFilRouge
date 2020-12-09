<?php

namespace App\Entity;

use App\Repository\PromosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromosRepository::class)
 */
class Promos
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
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="date")
     */
    private $referenceAgate;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateFinProvisoire;

    /**
     * @ORM\Column(type="date")
     */
    private $fabrique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateFinReelle;

    /**
     * @ORM\ManyToOne(targetEntity=Referenciels::class, inversedBy="promos")
     */
    private $referenciel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getReferenceAgate(): ?\DateTimeInterface
    {
        return $this->referenceAgate;
    }

    public function setReferenceAgate(\DateTimeInterface $referenceAgate): self
    {
        $this->referenceAgate = $referenceAgate;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFinProvisoire(): ?string
    {
        return $this->dateFinProvisoire;
    }

    public function setDateFinProvisoire(string $dateFinProvisoire): self
    {
        $this->dateFinProvisoire = $dateFinProvisoire;

        return $this;
    }

    public function getFabrique(): ?\DateTimeInterface
    {
        return $this->fabrique;
    }

    public function setFabrique(\DateTimeInterface $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getDateFinReelle(): ?string
    {
        return $this->dateFinReelle;
    }

    public function setDateFinReelle(string $dateFinReelle): self
    {
        $this->dateFinReelle = $dateFinReelle;

        return $this;
    }

    public function getReferenciel(): ?Referenciels
    {
        return $this->referenciel;
    }

    public function setReferenciel(?Referenciels $referenciel): self
    {
        $this->referenciel = $referenciel;

        return $this;
    }
}
