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

class VoirMonDevisController extends AbstractController
{
     #[Route('/voir/mon/devis', name: 'app_voir_mon_devis')]
    // public function index(): Response
    // {
    public function index(Request $request,SessionInterface $session , ManagerRegistry $doctrine): Response
    {
        $session = $request->getSession();

        $entityManager = $doctrine->getManager();
        $mail = $this->getUser()->getUserIdentifier();
        $monUser = new User();
        $monUser = $doctrine->getRepository(User::class)->findOneBy(array('email' => $mail));
        $devis = $doctrine->getRepository(Devis::class)->findBy(array('user' => $monUser));


        return $this->render('voir_mon_devis/index.html.twig', [
            'controller_name' => 'VoirMonDevisController',
            'devis' => $devis,
        ]);
    }
}
