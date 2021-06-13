<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProgramType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Service\Slugify;

use App\Entity\Program;
use App\Entity\Saison;
use App\Entity\Episode;

class ProgramController extends AbstractController
{

      /**
     * The controller for the program add form
     *
     * @Route("/programs/new", name="new_prog")
     */
    public function new(Request $request, Slugify $slugify) : Response
    {
        // Create a new Program Object
        $program = new Program();


        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Render the form

        $form->handleRequest($request);
        // Was the form submitted ?
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager

            // saisir le titre slugué en base de données à la création de la série
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);

            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($program);

       


            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }

        return $this->render('program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }




        /**
     * @Route("/programs/show/{url}", methods={"GET"},  name="program_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"url": "Slug"}})
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
    * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "slug"}})
    */

    public function showEpisode(Program $program, Saison $saison, Episode $episode): Response
    {
    
         //http://localhost:8000/programs/16/seasons/1/episode/3
        return $this->render('program/myEpisode.html.twig', [
            'program' => $program,'saison' => $saison,'episode' => $episode,
        ]);
    }
}