<?php

namespace App\Controller;

use App\Entity\GroupeTag;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;


class GroupeTagController extends AbstractController
{

    public function putGroupesTAgs($id, SerializerInterface $serializer, Request $request , EntityManagerInterface $manager)
    {
        //recupération des données sur postman
        $postman = $serializer->decode($request->getContent(), 'json');
        $grpTag = $manager->getRepository(GroupeTag::class)->find($id);
        foreach($postman["tag"] as $tag) {
            $grpTag->addTag($manager->getRepository(Tag::class)->find($tag["id"]));
        }
        $manager->flush();
        return $this->json($grpTag);
    }

}
