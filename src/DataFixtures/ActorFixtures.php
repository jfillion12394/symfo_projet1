<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTEURS = [
        'Andrew Lincoln',
        'Norman Reedus ',
        'Lauren Cohan',
        'Danai Gurira',
        'Tom Selleck',
        'John Hillerman',
        'Roger E. Mosley',
        'Alyson Hannigan',
        'William Shatner',
        'Leonard Nimoy'
    ];
    

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTEURS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}
