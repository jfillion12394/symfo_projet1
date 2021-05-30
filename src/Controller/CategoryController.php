<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Entity\Program;

class CategoryController extends AbstractController
{
 

         /**
     * @Route("/categories",  name="category_")
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

    $categoryId = $cat->getId();
    $program = $this->getDoctrine()
    ->getRepository(Program::class)
    ->findBy(['category' => $categoryId]);
    return $this->render('category/show.html.twig', [
        'programs' => $program,
    ]);

     }


 
}