<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CmRepository::class)
 * @ApiResource (
 *     normalizationContext={"groups"={"read:user"}},
 *     routePrefix="/",
 *
 *
 * )
 */
class Cm extends User
{

}
