<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Saison;


class SeasonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $prgIndex = 0;
        $season = new Saison();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Season description or synopsis The Walking Dead");
        $season->setMaSaison($this->getReference('prg_0'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();
        $prgIndex++;

        $season = new Saison();
        $season->setNumber(2);
        $season->setYear(2012);
        $season->setDescription("Season description or synopsis The Walking Dead");
        $season->setMaSaison($this->getReference('prg_0'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();
        $prgIndex++;

        $season = new Saison();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Season description or synopsis Penny Dreadful");
        $season->setMaSaison($this->getReference('prg_1'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();
        $prgIndex++;

        $season = new Saison();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Season description or synopsis Zombie Park");
        $season->setMaSaison($this->getReference('prg_2'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();
        $prgIndex++;

        $season = new Saison();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Season description or synopsis Blood Invasion");
        $season->setMaSaison($this->getReference('prg_3'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();
        $prgIndex++;

        $season = new Saison();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Season description or synopsis Returning from the grave");
        $season->setMaSaison($this->getReference('prg_4'));
        $this->addReference('sea_' . $prgIndex, $season);
        $manager->persist($season);
        $manager->flush();  
        $prgIndex++;
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
          SeasonXpisodeFixtures::class,
         
        ];
    }
}
