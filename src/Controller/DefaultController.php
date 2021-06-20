<?php
namespace App\Controller;
use App\Entity\Program;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
        /**
     * @Route("/", name="default")
     */

    public function index(): Response
    {

        $programs = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findAll();

        return $this->render('index.html.twig', [
            'programs' => $programs,
         ]);
    }


   /**
     * @Route("/exit", name="exit")
     */

    public function logout(): Response
    {
        return $this->render('logout.html.twig');
    }



}