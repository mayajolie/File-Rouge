<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPartController extends AbstractController
{
    /**
     * @Route("/admin/part", name="admin_part")
     */
    public function index()
    {
        return $this->render('admin_part/index.html.twig', [
            'controller_name' => 'AdminPartController',
        ]);
    }
}
