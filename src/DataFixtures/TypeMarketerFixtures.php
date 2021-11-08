<?php

namespace App\DataFixtures;

use App\Entity\TypeMarketer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeMarketerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $typeMarketers = ['SPA', 'Eleveur'];

        foreach ($typeMarketers as $typeMarketer) {
            $tyMar = new TypeMarketer();
            $tyMar->setName($typeMarketer);
            $manager->persist($tyMar);
        }
        $manager->flush();
    }
}
