<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Haie;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController
{
    #[Route('/creation', name: 'app_creation')]

    public function index(ManagerRegistry $doctrine): Response
    {
        $POST = Request::createFromGlobals();

        $session = new Session();

        

        $categorie = $doctrine->getRepository(Categorie::class)->findAll(); //findAll 
        

       


        return $this->render('creation/index.html.twig', [
            'controller_name' => 'CreationController',
            'categorie' => $categorie,
           
         ]);
    }
}
