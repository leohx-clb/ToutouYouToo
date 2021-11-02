<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $departments = [
            ['name'=> 'Loire atlantique', 'number' => 44],
            ['name'=> 'Rhône', 'number' => 69],
            ['name'=> 'Paris', 'number' => 75],
            ['name'=> 'Bouches du Rhône', 'number' => 13],
            ['name'=> 'Ardèche', 'number' => 07],
            ['name'=> 'Isère', 'number' => 38]
        ];

        foreach ($departments as $department){
            $dep = new Department();
            $dep->setName($department['name']);
            $dep->setNumber($department['number']);
            $manager->persist($dep);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
