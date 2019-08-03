<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Partenaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST","GET"})
     */
    public function admin(Request $request, UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        $profit="";
        if (isset($values->username, $values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
        
            $profit=$values->profit;

            if($profit=='caisier'){
            $user->setRoles(['ROLE_CAISSIER']);
            }
            else if ($profit=='admin') {
                $user->setRoles(['ROLE_ADMIN_PART']);
                $repo = $this->getDoctrine()->getRepository(Partenaires::class);
                $partenaire = $repo->find($values->partenaire);
                $user->setPartenaire($partenaire);
                $user->setEtat($values->etat);

            }
            elseif ($profit=='user') {
                $user->setRoles(['ROLE_USER']);
                $repo = $this->getDoctrine()->getRepository(Partenaires::class);
                $partenaire = $repo->find($values->partenaire);
                $user->setPartenaire($partenaire);
                $user->setEtat($values->etat);
            }
            else{
                $data =[
                    'statu'=>400,
                    'messag'=>'Ce profit n\'existe pas'
                ];
                return new JsonResponse($data ,400);
            }
            $user->setNom($values->nom);
            $user->setPrenom($values->prenom);
            $user->setAdresse($values->adresse);
            $user->setTelephone($values->telephone);
            $user->setEmail($values->email);
           


            
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé',
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password',
        ];

        return new JsonResponse($data, 500);
    } 

    /**
     * @Route("/loginchek", name="login", methods={"POST","GET"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }
}
