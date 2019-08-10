<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

 /**
  * @Route("/api")
  */
class AdminPartController extends AbstractController
{
    /**
     * @Route("/fd", name="adminpart")
     */
    public function index()
    {
        return $this->render('admin_part/index.html.twig', [
            'controller_name' => 'AdminPartController',
        ]);
    }
}
