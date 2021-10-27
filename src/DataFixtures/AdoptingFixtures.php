<?php

namespace App\DataFixtures;

use App\Entity\Adopting;
use App\Entity\Marketer;
use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AdoptingFixtures extends Fixture implements DependentFixtureInterface
{
    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
       $this->cityRepository = $cityRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $marketers = [
            ['lastName'=> 'Redford',
                'firstName' => 'Robert',
                'email' => 'robert.redford@gmail.com',
                'password' => 'toto',
                'name' => 'Robert Redford'],
            ['lastName'=> 'Travolta',
                'firstName' => 'John',
                'email' => 'john.travolta@gmail.com',
                'password' => 'toto',
                'name' => 'John Travolta'],
            ['lastName'=> 'Gabble',
                'firstName' => 'Clark',
                'email' => 'clark.gabble@gmail.com',
                'password' => 'toto',
                'name' => 'Clark Gabble']
         ];
        $cities = $this->cityRepository->findAll();
        $i=0;
        foreach ($marketers as $marketer){
        $mk = new Adopting();
            $mk->setFirstName($marketer['firstName']);
            $mk->setlastName($marketer['lastName']);
            $mk->setEmail($marketer['email']);
            $mk->setpassword($marketer['password']);
            $mk->setIsAdministrator(false);
            $mk->setcity($cities[$i]);

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
        ];
    }
}
