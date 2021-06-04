<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryType;


use App\Entity\Program;
use App\Entity\Category;


class CategoryController extends AbstractController
{
 

  /**
     * The controller for the category add form
     *
     * @Route("/categories/new", name="new")
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $category = new Category();
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        // Render the form

        $form->handleRequest($request);
        // Was the form submitted ?
        
        if ($form->isSubmitted()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($category);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }


         /**
     * @Route("/categories",  name="category_index")
     */
    public function index()
    {
        $programs = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        return $this->render('category/index.html.twig', [
            'programs' => $programs,
         ]);
    }






           /**
     * @Route("/categories/{categoryName}",name="category_show")
     */
    public function show(string $categoryName): Response
    {
        $cat = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findOneBy(['name' => $categoryName]);

    if (!$cat) {
        throw $this->createNotFoundException(
            '404 : "Aucune catégorie nommée : '.$categoryName
        );
    }
    
//récupérer les données de la catégories
$categoryId = $cat->getId();
$categoryName = $cat->getName();


$program = $this->getDoctrine()->getRepository(Program::class)->findBy(['category' => $categoryId]);

    

    


    return $this->render('category/show.html.twig', [
        'programs' => $program,
    ]);

     }


    
}