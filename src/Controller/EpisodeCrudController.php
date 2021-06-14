<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Form\EpisodeType;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugify;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/episode/crud")
 */
class EpisodeCrudController extends AbstractController
{
    /**
     * @Route("/", name="episode_crud_index", methods={"GET"})
     */
    public function index(EpisodeRepository $episodeRepository): Response
    {
        return $this->render('episode_crud/index.html.twig', [
            'episodes' => $episodeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="episode_crud_new", methods={"GET","POST"})
     */
    public function new(Request $request,Slugify $slugify,MailerInterface $mailer): Response
    {
        $episode = new Episode();
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

               // saisir le titre slugué en base de données à la création de l'épisode
               $slug = $slugify->generate($episode->getTitle());
               $episode->setSlug($slug);

            $entityManager->persist($episode);
            $entityManager->flush();

            //var_dump($episode);
     

            $email = (new Email())
            ->from('jfillion12394@gmail.com')
            ->to( $this->getParameter('mailer_to'))
            ->subject('New episode coming up: ' . $episode->getTitle())
            ->html($this->renderView('program/newEpisode.html.twig', ['episode' => $episode]));
            $mailer->send($email);

            return $this->redirectToRoute('episode_crud_index');
        }

        return $this->render('episode_crud/new.html.twig', [
            'episode' => $episode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="episode_crud_show", methods={"GET"})
     */
    public function show(Episode $episode): Response
    {
        return $this->render('episode_crud/show.html.twig', [
            'episode' => $episode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="episode_crud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Episode $episode,Slugify $slugify): Response
    {
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                 // saisir le titre slugué en base de données à la création de l'épisode
                 $slug = $slugify->generate($episode->getTitle());
                 $episode->setSlug($slug);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('episode_crud_index');
        }

        return $this->render('episode_crud/edit.html.twig', [
            'episode' => $episode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="episode_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Episode $episode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$episode->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($episode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('episode_crud_index');
    }
}
