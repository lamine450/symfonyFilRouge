<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\service\mesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userpasswordEncoder;

    /**
     * UserController constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator,UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->userpasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @Route(
     *      name="addUser" ,
     *      path="/api/admin/users" ,
     *     methods={"POST"} ,
     *     defaults={
     *         "__controller"="App\Controller\UserController::addUser",
     *         "_api_resource_class"=User::class,
     *         "_api_collection_operation_name"="adding"
     *         }
     *     )
     * @param Request $request
     * @return JsonResponse
     */

    public function addUser(Request $request){
        //all data
        $user = $request->request->all();

        // $profil=$request->request->all()->photo;
        //Recuperation de l'image
        $photo = $request->files->get('image');

        $user = $this->serializer->denormalize($user,"\App\Entity\User",true);
        if(!$photo){
            return new JsonResponse("Veuillez ajouter votre image",Response::HTTP_BAD_REQUEST,[],true);
        }
        $photoBlob = fopen($photo->getRealPath(),"rb");

        $user->setImage($photoBlob);


        /*$errors = $this->validator->validate($user);

        if (count($errors)){
            $errors = $this->serializer->serialize($errors,'json');
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }*/
        $password =  $user->getPassword();
        $user->setPassword($this->userpasswordEncoder->encodePassword($user,$password));


        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json("success",201);
    }

    /**
     * @Route(
     * "/api/admin/users/{id}",
     *  name="update_user",
     *  methods={"PUT"},
     *  defaults={
     *      "_api_resource_class" = User::class,
     *      "_api_item_operation_name" = "update_user"
     *      }
     *    )
     * @param mesService $serve
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return JsonResponse|Response
     */
    public function updateUser(mesService $serve, Request $request,EntityManagerInterface $manager){
    //Récuperation de l'objet dans la base de données
    $userData = $request->attributes->get("data");
    //dd($userData);
    $data = $serve->putData($request);
    foreach ($data as $k => $v) {
        $setter = 'set' . ucfirst($k);
        if (!method_exists($userData, $setter)) {
            return new Response("La méthode $setter() n'éxiste pas dans l'entité User");
        }
        $userData->$setter($v);
    }
    $manager->persist($userData);
    $manager->flush();

    return new JsonResponse("success", Response::HTTP_CREATED, [], true);
}

}