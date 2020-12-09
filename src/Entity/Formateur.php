<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * * @ApiResource (
 *     normalizationContext={"groups"={"read:user"}},
 *     routePrefix="/",
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *
 *
 *
 * )
 */
class Formateur extends User
{

}
