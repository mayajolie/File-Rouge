<?php

namespace App\Controller;

use App\Entity\Tarifs;
use App\Entity\Transaction;
use App\Entity\ComptBancaire;
use App\Form\TransactionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="transaction_index", methods={"GET"})
     */
    public function index(TransactionRepository $transactionRepository): Response
    {
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/trans", name="transaction_new", methods={"GET","POST"})
     */
    public function new(Request  $request, SerializerInterface $serializer, EntityManagerInterface $entityManager,ValidatorInterface $validator): Response
    {
        
   
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        $Values =$request->request->all();
        $form->submit($Values);
        $transaction->setDateTrans(new \DateTime());
        //$montant=$Values['montant'];
        //recuper id de lutulisateur qui fait le transaction
        $user=$this->getUser();
        //recupere le numero du compte bancaire
        $part=$user->getCompteBancaire();
        //on recupere le montant qui est dans ce compte
        $repo = $this->getDoctrine()->getRepository(ComptBancaire::class);
        $numcompt = $repo->findOneBy(['numCompt'=>$part]);
        $val=$numcompt->getSolde();
        //on recupere lensemble des tarifs
        $repo = $this->getDoctrine()->getRepository(Tarifs::class);
        $tar = $repo->findAll();
       // var_dump($tar); die();
        foreach ($tar as $value) {
            $min=$value->getBorneInferieur();
            $max=$value->getBorneSuperieur();
            if(($min<="30000") && ("30000">=$max)){
                $com=$value->getValeur();
            }
        }
        $etat=(($com*30)/100);
        $envoye=(($com*3)/100);


        var_dump($etat);

        die();
        
        
        
        
        
        
        
        
        
        
        //on compare le montant qu'on veut recuperer et le montant qui existe dans le compte
        if ($montant<$val){
        //on recupere l    
        foreach ($tar as $value) {
            $min=$value->getBorneInferieur();
            $max=$value->getBorneSuperieur();
            if(($min<="3000") && ("3000">=$max)){
                $com=$value->getValeur();
            }
        }
        $etat=(($com*30)/100);
        }
        
        var_dump($val); die();
        

        $type=$Values['type'];
         if ($type=='1') {


        } 
        elseif ($type=='2') {
        }
        

        $errors = $validator->validate($user);
        if(count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        } 
        $entityManager->persist($compb); 
        $entityManager->flush();
            
        

            $data =[
                'STATUS' => 201,
                'MESSAGE' => 'Le partenaire a été créé son compte bancaire et son administrateur',
            ];
            return new JsonResponse($data, 201);
       
    }

    /**
     * @Route("/{id}", name="transaction_show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transaction_index');
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaction_index');
    }
}
