<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Program;
use App\Entity\Actor;
use Symfony\Component\Validator\Constraints\Length;

class ActorController extends AbstractController
{
        /**
     * @Route("/actor/{id}", methods={"GET"},  name="actor_show")
     */

  
    public function show(Actor $actor): Response
    {
        $l= count($actor->getPrograms()); // longueur du tableau
        $programTable =[];
            for ($i=0; $i<$l;$i++)
            {
                $programTable[$i]["title"]=$actor->getPrograms()[$i]->getTitle();
                $programTable[$i]["summary"]=$actor->getPrograms()[$i]->getSummary();
                $programTable[$i]["poster"]=$actor->getPrograms()[$i]->getPoster();
                $programTable[$i]["id"]=$actor->getPrograms()[$i]->getId();
            }


    return $this->render('program/actor.html.twig', [
        'programs' => $programTable,'actor' => $actor,
    ]);
    }
 

}