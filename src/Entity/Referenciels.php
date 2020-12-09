<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReferencielsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReferencielsRepository::class)
 * @ApiResource(
 *     denormalizationContext={"groups"={"write:ref"}},
 *     normalizationContext={"groups"={"read:ref"}},
 *     routePrefix="/admin",
 *
 *          collectionOperations={"get","post"},
 *            itemOperations={"put","get"},
 * )
 */
class Referenciels
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:ref","read:GroupeCompetence"})
     * @Assert\NotBlank
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:ref","read:GroupeCompetence"})
     * @Assert\NotBlank
     */
    private $présentation;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:ref","read:GroupeCompetence"})
     */
    private $programme;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:ref",read:GroupeCompetence"})
     * @Assert\NotBlank
     */
    private $critéreAdmission;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:ref","read:GroupeCompetence"})
     * @Assert\NotBlank
     */
    private $critéreEvaluation;

    /**
     * @ORM\OneToMany(targetEntity=Promos::class, mappedBy="referenciel")
     */
    private $promos;

    public function __construct()
    {
        $this->promos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrésentation(): ?string
    {
        return $this->présentation;
    }

    public function setPrésentation(string $présentation): self
    {
        $this->présentation = $présentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritéreAdmission(): ?string
    {
        return $this->critéreAdmission;
    }

    public function setCritéreAdmission(string $critéreAdmission): self
    {
        $this->critéreAdmission = $critéreAdmission;

        return $this;
    }

    public function getCritéreEvaluation(): ?string
    {
        return $this->critéreEvaluation;
    }

    public function setCritéreEvaluation(string $critéreEvaluation): self
    {
        $this->critéreEvaluation = $critéreEvaluation;

        return $this;
    }

    /**
     * @return Collection|Promos[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promos $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReferenciel($this);
        }

        return $this;
    }

    public function removePromo(Promos $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReferenciel() === $this) {
                $promo->setReferenciel(null);
            }
        }

        return $this;
    }
}
