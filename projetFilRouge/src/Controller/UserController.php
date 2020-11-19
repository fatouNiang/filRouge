<?php

namespace App\Controller;

use App\Entity\User;
use App\Controller\UserController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $encoder;
    private $serializer;
    private $validator;
    private $em;


    public function __construct(
        UserPasswordEncoderInterface $encoder,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $em
    ){
        $this->encoder=$encoder;
        $this->serializer=$serializer;
        $this->validator=$validator;
        $this->em=$em;
    }

 /**
     * @Route(
     *     name="addUser",
     *     path="/api/admin/users",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::add",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="add_user"
     *     }
     * )
     */
    public function add(Request $request)
{
   
      $user=$request->request->all();
      $photo =$request->files->get("photo");
      $user=$this->serializer->denormalize($user,"App\Entity\User",true);
  
      $photoB=fopen($photo->getRealPath(),"rb");
      $user->setPhoto($photoB);

      $password="jnkk,df,,";
      $user->setPassword($this->encoder->encodePassword($user,$password));

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      
      return $this->json("success",201);
        
}
}