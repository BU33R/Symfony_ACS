<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use App\Entity\Project;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProjectFixtures extends Fixture {

    public function load(ObjectManager $manager):void {

            for ($i = 1; $i <= mt_rand(4, 6); $i++) {

                $project = new Project();
          
                $project->setTitle("Titre du projet n°$i")
                        ->setDescription("<p>Contenu de l'article n°$i</p>")
                        ->setImage("https://via.placeholder.com/350x150")
                        ->setGithub("https://github.com/DylanCharton")
                        ->setWeblink("https://dylanc903.promo-93.codeur.online/");

                $manager->persist($project);
        }

        $manager->flush();
    }
} 

    
        

