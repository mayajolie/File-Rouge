<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Partenaires;
use App\Entity\CompBancaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
  
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    //===================================================>Login<==============================£===============================================================================================//
    /**
     * @Route("/login", name="loginch", methods={"POST"})
     * @param Request $request
     * @param JWTEncoderInterface $JWTEncoder
     * @return JsonResponse
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request,JWTEncoderInterface $JWTEncoder)
    {
        $values = json_decode($request->getContent());
        $user= $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$values->username]);
        
        if (!$user) 
        {
            throw $this->createNotFoundException('Nom d\'Utilisateur incorrect');
        }
        $isValid = $this->passwordEncoder->isPasswordValid($user,$values->password);
        var_dump($isValid);
        if (!$isValid) 
        {
            throw new BadCredentialsException();
        }
        //===============================================================================
     
        $profil = $user->getRoles(); 
        var_dump($profil); 
        $statuser = $user->getEtat();
        var_dump($statuser); 
      
        if (!empty($statuser) && $profil !=['ROLE_CAISIER']) {
        $partenstat =$user->getPartenaire()->getEtat();
     var_dump($partenstat); 
        
        if ($partenstat =='bloquer') 
        {
            $data = [
                'stat' => 400,
                'messge' => 'Accés refusé! votre prestataire a été bloqué.'
            ];
            return new JsonResponse($data, 400);
        }
        elseif ($partenstat == 'Actif' ||  $statuser == 'bloquer')
        {
            $data = [
                'stat' => 400,
                'mesge' => 'Votre accés est bloqué,veillez vous adressez à votre administrateur!'
            ];
            return new JsonResponse($data, 400);
        }else{
        $token = $JWTEncoder->encode([
            'username' => $user->getUsername(),
            'exp' => time() + 3600 // 1 hour expiration
        ]);
        return new JsonResponse(['token' => $token]);
        }
        }
        else
        {
            $token = $JWTEncoder->encode([
                'username' => $user->getUsername(),
                'exp' => time() + 3600 // 1 hour expiration
            ]);

            return new JsonResponse(['token' => $token]);
        }
    }
    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @IsGranted({"ROLE_ADMIN","ROLE_SUPER_ADMIN"},message="vous netes pas autoriser a ajouter des utilisateur")
     */
    public function addUser(Request $request,UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer,ValidatorInterface $validator)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $Values =$request->request->all();
        $form->submit($Values);

        $Files=$request->files->all()['imageName'];
        $profil=$Values['profil'];
        switch ($profil) {
            case 1:
                $user->setRoles(['ROLE_ADMIN']);
                $parte=$this->getUser()->getPartenaire();
                $user->setPartenaire($parte);
                break;
            case 2:
                $user->setRoles(['ROLE_CAISIER']);
                break;
            case 3:
               
                $user->setRoles(['ROLE_USER']);
                $parte=$this->getUser()->getPartenaire();
                $user->setPartenaire($parte);

                break;
            default:
                $data = [
                    'statuts' => 400,
                    'message' => 'Ce profil n\'existe pas,veillez réctifier votre profil!'
                ];
                return new JsonResponse($data, 400);
        }
        
        $user->setPassword($passwordEncoder->encodePassword($user,$form->get('plainPassword')->getData()));
        $user->setEtat('bloquer');      


        $user->setImageFile($Files);
            $entityManager = $this->getDoctrine()->getManager();
          $errors = $validator->validate($user);
                if(count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                        'Content-Typle' => 'applicatlion/json'
                    ]);
                } 
                $entityManager->persist($user);
                $entityManager->flush();
                $data = [
                  'statut' => 201,
                  'massage' => 'L"utilisateur été bien ajouté'
                ];
                return new JsonResponse($data, 201);

               
            }
            //========================Bloquer un utilisateur========================£===============================================================================================//
    /**
     * @Route("/utilisateur/{id}", name="utilisaUpdate", methods={"PUT"})
     * @IsGranted({"ROLE_SUPER_ADMIN","ROLE_ADMIN"},message="Acces Refusé!Veillez vous connecter en tant que super administrateur.")
     */
    public function updat(Request $request, SerializerInterface $serializer, User $user, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $utilisaUpdate = $entityManager->getRepository(User::class)->find($user->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $values) {
            if ($key && !empty($values)) {
                $status = ucfirst($key);
                $setter = 'set' . $status;
                $utilisaUpdate->$setter($values);
            }
        }
        $errors = $validator->validate($utilisaUpdate);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'ContentType' => 'applications/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'statut' => 200,
            'message' => 'Le statuts de l\'utilisateur a été mis à jour'
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/modif/{id}", name="bloquer", methods={"PUT"})
     * @IsGranted({"ROLE_ADMIN"},message="vous netes pas autoriser a ajouter des utilisateur")

     */
    public function allouerCompte(Request $request, SerializerInterface $serializer, User $user, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
       
        $adpart=$this->getUser();  
  
        $part=$adpart->getPartenaire();
        $compt=$part->getComptBancaires();
       $numero=$compt[0]->getNumCompt();
        foreach ($compt as $value) {
            if ($value->getNumCompt()!= $numero) {
              $newne=$value->getNumCompt();
                break;
            } 
        }
       
       
        $bloqueP = $entityManager->getRepository(User::class)->find($user->getId());
         $user->setCompteBancaire($newne);
        $errors = $validator->validate($bloqueP);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');

            return new Response($errors, 500, [
                'Content-Type' => 'application/json',
            ]);
        }
        $entityManager->flush();
        $data = [
            'statu' => 200,
            'messag' => 'Le compte a ete bien allouer',
        ];

        return new JsonResponse($data);
    }
   

}
