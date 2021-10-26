<?php

namespace App\DataFixtures;

use App\Entity\Race;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RaceFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $raceNames = [
            'Labrador',
            'Berger allemand',
            'Husky de Sibérie',
            'Shiba Inu',
        ];


        foreach ($raceNames as $raceName) {
            $race = new Race();
            $race->setName($raceName);

            $manager->persist($race);
        }

        $manager->flush();
    }
}