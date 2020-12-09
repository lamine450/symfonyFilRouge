<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 *     denormalizationContext={"groups"={"write:groupe"}},
 *     normalizationContext={"groups"={"read:groupe"}},
 *     routePrefix="/admin",
 *
 *          collectionOperations={"get","post"},
 *              itemOperations={"put","get",
 *                "delete_apprenat"={
 *                  "method"="DELETE",
 *                  "path"="/api/admin/groupes/{id}/apprenat/{id1}",
 *
 *     }
 *     }
 *
 * )
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"read:Groupe" ,"write:groupe"})
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:Groupe" ,"write:groupe"})
     * @Assert\NotBlank(message="Ajouter le statut du Groupe")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Groupe" ,"write:groupe"})
     * @Assert\NotBlank(message="Ajouter le type du Groupe")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Groupe" ,"write:groupe"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenat::class, inversedBy="groupes")
     */
    private $apprenat;

    public function __construct()
    {
        $this->apprenat = new ArrayCollection();
    }

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

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    /**
     * @return Collection|Apprenat[]
     */
    public function getApprenat(): Collection
    {
        return $this->apprenat;
    }

    public function addApprenat(Apprenat $apprenat): self
    {
        if (!$this->apprenat->contains($apprenat)) {
            $this->apprenat[] = $apprenat;
        }

        return $this;
    }

    public function removeApprenat(Apprenat $apprenat): self
    {
        $this->apprenat->removeElement($apprenat);

        return $this;
    }
}
