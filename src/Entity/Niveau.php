<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 * @ApiResource(
 *     denormalizationContext={"groups"={"write:niveau"}},
 *     normalizationContext={"groups"={"read:niveau"}},
 *     routePrefix="/admin",
 *
 *          collectionOperations={"get","post"},
 *              itemOperations={"put","get"}
 * )
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"write:grpc" ,"write:niveau", "write:cpt"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:niveau","write:niveau","write:grpc", "write:cpt"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:niveau","write:niveau", "write:grpc" ,"write:cpt"})
     */
    private $critéreEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:niveau","write:niveau", "write:grpc" ,"write:cpt"})
     */
    private $groupeAction;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="Niveau",cascade={ "persist"})
     */
    private $competence;

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

    public function getCritéreEvaluation(): ?string
    {
        return $this->critéreEvaluation;
    }

    public function setCritéreEvaluation(string $critéreEvaluation): self
    {
        $this->critéreEvaluation = $critéreEvaluation;

        return $this;
    }

    public function getGroupeAction(): ?string
    {
        return $this->groupeAction;
    }

    public function setGroupeAction(string $groupeAction): self
    {
        $this->groupeAction = $groupeAction;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
