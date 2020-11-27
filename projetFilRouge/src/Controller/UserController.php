<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\UserService;
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
    private$uploadImage;


    public function __construct(
        UserPasswordEncoderInterface $encoder,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $em,
        UserService $userService
    ){
        $this->encoder=$encoder;
        $this->serializer=$serializer;
        $this->validator=$validator;
        $this->em=$em;
        $this->userService=$userService;
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
        $user = $request->request->all();
        $photo= $this->userService->uploadImage($request);
        $user = $this->serializer->denormalize($user,"App\Entity\User",true);
            
        $user->setPhoto($photo);
        $errors = $this->validator->validate($user);
        if (count($errors)){
            $errors = $this->serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        $password = $user->getPassword();
       $user->setPassword($this->encoder->encodePassword($user,$password));
       $user->setArchivage(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        return $this->json("success",201);
     }
     
     /**
     * @Route(
     *     name="putUser",
     *     path="/api/admin/users/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::put",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="put_user"
     *     }
     * )
     */
    public function put(UserRepository $repoUser)
    {
        $update = $em->getRepository();
        
    //     $user = $request->request->all();
    //     $photo = $request->files->get("photo");
    //     $user = $this->serializer->denormalize($user,"App\Entity\User",true);
    //      if(!$photo)
    //      {
    //          return new JsonResponse("veuillez mettre une images",Response::HTTP_BAD_REQUEST,[],true);
    //      }
    //         $photoBlob = fopen($photo->getRealPath(),"r+");
    //          $user->setPhoto($photoBlob);
    //     $errors = $this->validator->validate($user);
    //     if (count($errors)){
    //         $errors = $this->serializer->serialize($errors,"json");
    //         return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
    //     }
    //     $password = $user->getPassword();
    //    $user->setPassword($this->encoder->encodePassword($user,$password));
    //    $user->setArchivage(false);

    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($user);
    //     $em->flush();
        
    //     return $this->json("success",201);
     }
     
    }