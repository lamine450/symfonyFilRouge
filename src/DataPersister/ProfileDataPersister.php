<?php

namespace App\DataPersister;

use App\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


final class ProfileDataPersister  implements ContextAwareDataPersisterInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profile;
    }


    public function persist($data, array $context = [])
    {
        $this->em->persist($data);
        $this->em->flush();
    }


    public function remove($data, array $context = [])
    {
        $data->setArchive(1);
        $this->em->flush();
        return $data;
    }
}
