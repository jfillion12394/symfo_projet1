<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use App\Service\Slugify;

class SeasonXpisodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
       
        $episode = new Episode();
        $slugify = new Slugify();
        $episode->setTitle("Rip their heads off");
        $episode->setSynopsis("about ripping someone's head off");
        $episode->setSlug($slugify->generate($episode->getTitle()));
        $episode->setProgram($this->getReference('prg_0'));
        $episode->setSaison($this->getReference('sea_0'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle("He'll come around");
        $episode->setSlug($slugify->generate($episode->getTitle()));
        $episode->setSynopsis("new episode");
        $episode->setProgram($this->getReference('prg_0'));
        $episode->setSaison($this->getReference('sea_0'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle("How come I can't kill'em all");
        $episode->setSlug($slugify->generate($episode->getTitle()));
        $episode->setSynopsis("new episode");
        $episode->setProgram($this->getReference('prg_0'));
        $episode->setSaison($this->getReference('sea_0'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle("Nice shot!");
        $episode->setSlug($slugify->generate($episode->getTitle()));
        $episode->setSynopsis("new episode");
        $episode->setProgram($this->getReference('prg_0'));
        $episode->setSaison($this->getReference('sea_0'));
        $manager->persist($episode);
        $manager->flush();
       
       

    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
          ProgramFixtures::class
        
        ];
    }
}
