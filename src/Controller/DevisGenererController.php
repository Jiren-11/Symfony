<?php

namespace App\Controller;

use App\Entity\user;
use App\Entity\Devis;
use App\Entity\Haie;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DevisGenererController extends AbstractController
{
    /**
     * @Route("devis/generer/", name="app_devis_generer")
     */
    public function index(Request $request,SessionInterface $session , ManagerRegistry $doctrine): Response
    {

        $session = $request->getSession();

        $entityManager = $doctrine->getManager();

        $haie = $session->get('haie');
        $longueur = $session->get('longueur');
        $hauteur = $session->get('hauteur');

        $maHaie = $doctrine->getRepository(Haie::class)->find($haie);


        if (!empty($this->getUser())) {

            $mail = $this->getUser()->getUserIdentifier();
            $monUser = new User();
            $monUser = $doctrine->getRepository(User::class)->findOneBy(array('email' => $mail));
            
          

            $devis = new Devis();
            $devis->setUser($monUser);
            $devis->setHaie($maHaie);
            $devis->setHauteur($hauteur);
            $devis->setLongueur($longueur);


            $date = new DateTime('now');
            $devis->setDate($date);

            $entityManager->persist($devis);
            $entityManager->flush();

            return $this->render('devis_generer/index.html.twig', [
                'controller_name' => 'GenererDevisController',
                 'user' => $monUser,

            ]);
        }
    }
}