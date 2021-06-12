<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Program;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prgIndex = 0;
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSummary('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTEURS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program);
        $this->addReference('prg_' . $prgIndex, $program);
        $manager->flush();
        $prgIndex ++;

        $program = new Program();
        $program->setTitle('Penny DreadFull');
        $program->setSummary('Penny Dreadfull is back for more dread, watchout, folks!');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTEURS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $this->addReference('prg_' . $prgIndex, $program);
        $manager->persist($program);
        $manager->flush();
        $prgIndex ++;

        $program = new Program();
        $program->setTitle('Zombie Park');
        $program->setSummary('Youre gonna be freaking out for good this time with Zombies on the run accross town.');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTEURS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $this->addReference('prg_' . $prgIndex, $program);
        $manager->persist($program);
        $manager->flush();
        $prgIndex ++;

        $program = new Program();
        $program->setTitle('Blood Invasion');
        $program->setSummary('Theyre here to take over the earth whatever the cost. Go get mr Pointy, we re gonna need him bad.');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTEURS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $this->addReference('prg_' . $prgIndex, $program);
        $manager->persist($program);
        $manager->flush();
        $prgIndex ++;

        $program = new Program();
        $program->setTitle('Returning from the grave');
        $program->setSummary('If you think the departed ones are in the big slumber, youre in for a surprise!');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTEURS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $this->addReference('prg_' . $prgIndex, $program);
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
    
          CategoryFixtures::class,
          ActorFixtures::class
        ];
    }
}
