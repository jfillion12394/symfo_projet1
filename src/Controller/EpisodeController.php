<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Program;
use App\Entity\Saison;
use App\Entity\Episode;



class EpisodeController extends AbstractController
{
        /**
     * @Route("/episode/show/{id}", methods={"GET"}, requirements={"id"="\d+"},  name="episode_show")
     */

  
    public function show(Episode $episode): Response
    {
  
     $id= $episode->getId();

 $episode = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['saison' => $id]);

$saison = $this->getDoctrine()
->getRepository(Saison::class)
->findOneBy(['id' => $id]);

$SerieID = $saison->getMaSaison()->getId();
$SaisonID = $saison->getId();

        if (!$episode) {
        throw $this->createNotFoundException(
            'No episdoe with id : '.$id.' found in episdoe\'s table.'
        );
  }
     
    return $this->render('program/episode.html.twig', [
        'episodes' => $episode, 'serie' => $SerieID, 'saison' => $SaisonID,
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


           /**
    * @Route("/programs/{ProgrammId}/seasons/{saisonId}", name="program_episode_showepi")
    * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"ProgrammId": "id"}})
    * @ParamConverter("saison", class="App\Entity\Saison", options={"mapping": {"saisonId": "number"}})
    */


    public function showepi(Program $program, Saison $saison): Response
    {
       
         //http://localhost:8000/programs/16/seasons/1

         $myProgram = $program->getId(); // l'id de la série
         $mySeason = $saison->getId(); // l'id de la saison

         // recup les infos des épisode en fonctins de la série
         $episode = $this->getDoctrine()
         ->getRepository(Episode::class)
         ->findBy(['Program' => $myProgram, 'saison' => $mySeason]);

        return $this->render('program/episode.html.twig', [
            'serie' => $myProgram,'saison' => $mySeason,'episodes' => $episode,
        ]);
    }


}