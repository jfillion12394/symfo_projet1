<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use App\Entity\Episode;


/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{


    private $security;

    public function __construct(Security $secuirty)
    {
        $this->security = $secuirty;
    }

    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="comment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();



            // USER COURANT
        //récupérer l'utilisateur actuellement connecté
       $userEmail = $this->security->getUser()->getEmail();
       //récupérer l'objet user correspondant à l'utilisateur connecté actuellement
       $myUser  = $this->getDoctrine()
       ->getRepository(User::class)
       ->findBy(['email' => $userEmail]);
        // passer le user à l'objet comment
        $comment->setAuthor($myUser[0]);



        //EPISODE COURANT
        //recuperer l'épisode en cours
        $routeParameters = $request->attributes->get('_route_params');
        $episode_id = $routeParameters["id"];
        $myEpisode  = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['id' => $episode_id]);
         //passer l'épizsode à l'objet comment
        $comment->setEpisode($myEpisode[0]);



            $entityManager->persist($comment);
            $entityManager->flush();

            //Rediriger sur l'accueil pour le moment
            return $this->redirectToRoute('default');
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods={"POST"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index');
    }
}
