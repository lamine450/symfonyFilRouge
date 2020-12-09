<?php

namespace App\Controller;

use App\Repository\ApprenatRepository;
use App\Repository\GroupeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    public function  __construct(GroupeRepository $groupeRepository,ApprenatRepository $apprenatRepository, EntityManagerInterface $manager)
    {
       $this->groupeRepository = $groupeRepository;
       $this->apprenatRepository = $apprenatRepository;
       $this->manager = $manager;
    }
    /**
     * @Route(
     *     name="delete_apprenat",
     *     path="/api/admin/groupes/{id}/apprenat/{id1}",
     *     methods={"DELETE"},
     *     defaults={
     *          "_api_item_operation_name"="delete_apprenat_id",
     *     }
     * )
     *
     */
    public function deleteApprenat(int $id,$id1): Response
    {
        $groupe = $this->groupeRepository->find($id);
        $apprenat = $this->apprenatRepository->find($id1);
        $groupe->removeApprenat($apprenat);
        $this->manager->persist($groupe);

        $this->manager->flush();

        return new JsonResponse('Succes',Response::HTTP_OKeponse);

    }
}
