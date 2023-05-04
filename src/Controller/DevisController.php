<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Haie;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{

#[Route('/devis', name: 'app_devis')]
public function index(Request $request, ManagerRegistry $doctrine): Response
{
    $req = Request::createFromGlobals();

        $session = $request->getSession();
        $longueur = $req->get('longueur');
        $hauteur = $req->get('hauteur');
        $haie = $req->get('haie');

        if (!empty($this->getUser())) {

                $mail = $this->getUser()->getUserIdentifier();
                $monUser = new User();
                $monUser = $doctrine->getRepository(User::class)->findOneBy(array('email' => $mail));
        }
        $choix = $monUser->getTypeClient();

        $session->set('hauteur', $hauteur);
        $session->set('longueur', $longueur);
        $session->set('haie', $haie);

    $maHaie = $doctrine->getRepository(Haie::class)-> find($haie);

    


    

    return $this->render('devis/index.html.twig', [
        'controller_name' => 'DevisController', 
        
      
            'mahaie' =>  $maHaie
            ,'longueur'=> $longueur 
            , 'hauteur'=> $hauteur,
            'choix'=>$choix 
    ]);


}
}