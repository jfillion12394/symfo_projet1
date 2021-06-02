<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Program;
use App\Entity\Saison;

class ProgramController extends AbstractController
{
        /**
     * @Route("/programs/show/{id}", methods={"GET"}, requirements={"id"="\d+"},  name="program_show")
     */

  
    public function show($id): Response
    {
    
        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['id' => $id]);

    if (!$program) {
        throw $this->createNotFoundException(
            'No program with id : '.$id.' found in program\'s table.'
        );
    }


    $saison= $this->getDoctrine()
    ->getRepository(Saison::class)
    ->findBy(['MaSaison' => $id]);



    return $this->render('program/index.html.twig', [
        'program' => $program,'saisons' => $saison,
    ]);


    }


}