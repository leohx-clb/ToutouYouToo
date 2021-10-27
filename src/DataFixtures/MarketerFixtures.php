<?php

namespace App\DataFixtures;

use App\Entity\Marketer;
use App\Repository\CityRepository;
use App\Repository\TypeMarketerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MarketerFixtures extends Fixture implements DependentFixtureInterface
{
    protected CityRepository $cityRepository;
    protected TypeMarketerRepository $typeMarketerRepository;

    public function __construct(CityRepository $cityRepository, TypeMarketerRepository $typeMarketerRepository)
    {
       $this->cityRepository = $cityRepository;
       $this->typeMarketerRepository = $typeMarketerRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $marketers = [
            ['lastName'=> 'Cobain',
                'firstName' => 'Kurt',
                'email' => 'kurt.cobain@gmail.com',
                'password' => 'toto',
                'name' => 'Kurt Cobain'],
            ['lastName'=> 'Bowie',
                'firstName' => 'David',
                'email' => 'david.bowie@gmail.com',
                'password' => 'toto',
                'name' => 'David Bowie'],
            ['lastName'=> 'Jagger',
                'firstName' => 'Mick',
                'email' => 'mick.jagger@gmail.com',
                'password' => 'toto',
                'name' => 'Mick Jagger']
         ];
        $cities = $this->cityRepository->findAll();
        $typeMarketers = $this->typeMarketerRepository->findAll();
        $i=0;
        foreach ($marketers as $marketer){
        $mk = new Marketer();
            $mk->setFirstName($marketer['firstName']);
            $mk->setlastName($marketer['lastName']);
            $mk->setEmail($marketer['email']);
            $mk->setpassword($marketer['password']);
            $mk->setIsAdministrator(false);
            $mk->setcity($cities[$i]);
            $mk->setName($marketer['name']);
            if ($i<=1)
                $mk->setTypeMarketer($typeMarketers[0]);
            else
                $mk->setTypeMarketer($typeMarketers[1]);
            $i++;
            $manager->persist($mk);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        // TODO: Implement getDependencies() method.
        return [
            CityFixtures::class,
            TypeMarketerFixtures::class
        ];
    }
}
