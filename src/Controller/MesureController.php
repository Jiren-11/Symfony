<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Haie;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesureController extends AbstractController
{
    #[Route('/mesure', name: 'app_mesure')]
    
    public function index(ManagerRegistry $doctrine): Response
    {
        $POST = Request::createFromGlobals();
        
        
        $session = new Session(); //  on démarre la session
        $CHOIX = $POST->get('choix'); // la variable recupèrée du bouton radio du formulaire précédent (choix)
        $session->set('choix', $CHOIX); // variable de session chargée
        $haie = $doctrine->getRepository(Haie::class)->findAll(); //findAll 

        return $this->render('mesure/index.html.twig', [
            'controller_name' => 'MesureController',
            'choix' => $CHOIX,
            'haie'=> $haie, 
                ]);
    }
}