<?php

namespace App\DataFixtures;

use App\Entity\TypeMessage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeMessageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $typeMessages = ["Demande d'adoption", "Demande d'information"];

        foreach ($typeMessages as $typeMessage) {
            $tyMes = new TypeMessage();
            $tyMes->setName($typeMessage);
            $manager->persist($tyMes);
        }
        $manager->flush();
    }
}
