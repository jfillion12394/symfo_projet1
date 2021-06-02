<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Episode;
use App\Entity\Saison;

class EpisodeController extends AbstractController
{
        /**
     * @Route("/episode/show/{id}", methods={"GET"}, requirements={"id"="\d+"},  name="episode_show")
     */

  
    public function show($id): Response
    {
    
        $episode = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['saison' => $id]);

    if (!$episode) {
        throw $this->createNotFoundException(
            'No episdoe with id : '.$id.' found in episdoe\'s table.'
        );
    }

    return $this->render('program/episode.html.twig', [
        'episodes' => $episode,
    ]);


    }


}