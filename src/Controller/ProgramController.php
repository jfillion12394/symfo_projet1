<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use App\Entity\Program;
use App\Entity\Saison;
use App\Entity\Episode;

class ProgramController extends AbstractController
{
        /**
     * @Route("/programs/show/{id}", methods={"GET"}, requirements={"id"="\d+"},  name="program_show")
     */

    public function show(Program $program): Response
    {
        $saison= $this->getDoctrine()
        ->getRepository(Saison::class)
        ->findBy(['MaSaison' => $program->getId()]);

    return $this->render('program/index.html.twig', [
        'program' => $program,'saisons' => $saison,
    ]);

    }


    /**
    * @Route("/programs/{ProgrammId}/seasons/{saisonId}", name="program_season_show")
    * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"ProgrammId": "id"}})
    * @ParamConverter("saison", class="App\Entity\Saison", options={"mapping": {"saisonId": "id"}})
    */

    public function showSeason(Program $program, Saison $saison): Response
    {
        //http://localhost:8000/programs/16/seasons/1
        return $this->render('program/saison.html.twig', [
            'program' => $program,'saison' => $saison,
        ]);
    }

        /**
    * @Route("/programs/{ProgrammId}/seasons/{saisonId}/episode/{episodeId}", name="program_episode_show")
    * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"ProgrammId": "id"}})
    * @ParamConverter("saison", class="App\Entity\Saison", options={"mapping": {"saisonId": "id"}})
    * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "id"}})
    */

    public function showEpisode(Program $program, Saison $saison, Episode $episode): Response
    {
         //http://localhost:8000/programs/16/seasons/1/episode/3
        return $this->render('program/myEpisode.html.twig', [
            'program' => $program,'saison' => $saison,'episode' => $episode,
        ]);
    }

}