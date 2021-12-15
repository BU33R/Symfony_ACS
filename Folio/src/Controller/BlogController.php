<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController

{

    /**
    * @Route("/Projets", name="projects")
    */

    public function index(ProjectRepository $repo): Response
    {

        $projects = $repo->findAll();

        return $this->render('blog/index.html.twig', [

            'controller_name' => 'BlogController',
            'projects' => $projects

        ]);

    }

    /**
    * @Route("/", name="accueil")
    * 
    */

    public function accueil(){

        return $this->render('blog/home.html.twig', [

            'title' => 'Bienvenue ici !',
            'age' => 23

        ]);
    }

    /**   
    * @Route("/Projets/New", name="project_create")
    * @Route("/Projets/{id}/edit", name="project_edit")
    */

    public function create(Project $project = null, Request $request, EntityManagerInterface $manager){

        if(!$project){

            $project = new Project();
        }

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
        }


        return $this->render('blog/create.html.twig', [

            'formProject' => $form->createView(),
            'editMode' => $project->getId() !== null

        ]);

    }


    /**
    * @Route("/Projets/{id}", name="project_show")
    */

    public function show(Project $project){


        return $this->render('blog/show.html.twig',[

            'project' => $project
        ]);
    }




   


}
