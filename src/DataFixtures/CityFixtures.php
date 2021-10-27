<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Repository\DepartmentRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
       $this->departmentRepository = $departmentRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $cities = [
            ['name'=> 'Lyon', 'zipCode' => '69000'],
            ['name'=> 'Paris', 'zipCode' => '75000'],
            ['name'=> 'Marseille', 'zipCode' => '13000'],
            ['name'=> 'Privas', 'zipCode' => '07000'],
            ['name'=> 'Grenoble', 'zipCode' => '38000']
        ];
        $departments = $this->departmentRepository->findAll();
        $i=0;
        foreach ($cities as $city){
            $dep = new City();
            $dep->setName($city['name']);
            $dep->setZipCode($city['zipCode']);
            $dep->setDepartment($departments[$i]);
            $i++;
            $manager->persist($dep);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        // TODO: Implement getDependencies() method.
        return [
            DepartmentFixtures::class,
        ];
    }
}
