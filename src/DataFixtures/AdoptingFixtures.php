<?php

namespace App\DataFixtures;

use App\Entity\Adopting;
use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdoptingFixtures extends Fixture implements DependentFixtureInterface
{
    protected CityRepository $cityRepository;
    protected UserPasswordHasherInterface $hasher;

    public function __construct(CityRepository $cityRepository, UserPasswordHasherInterface $hasher)
    {
        $this->cityRepository = $cityRepository;
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $adoptings = [
            [
                'lastName' => 'admin',
                'firstName' => 'admin',
                'email' => 'admin.admin@admin.com',
                'password' => 'admin',
                'name' => 'admin',
            ],
            [
                'lastName' => 'admin',
                'firstName' => 'Robert',
                'email' => 'robert.redford@gmail.com',
                'password' => 'toto',
                'name' => 'Robert Redford',
            ],
            [
                'lastName' => 'Travolta',
                'firstName' => 'John',
                'email' => 'john.travolta@gmail.com',
                'password' => 'toto',
                'name' => 'John Travolta',
            ],
            [
                'lastName' => 'Gabble',
                'firstName' => 'Clark',
                'email' => 'clark.gabble@gmail.com',
                'password' => 'toto',
                'name' => 'Clark Gabble',
            ],
         ];
        $cities = $this->cityRepository->findAll();
        $i = 0;
        foreach ($adoptings as $adopting) {
            $ad = new Adopting();
            $ad->setFirstName($adopting['firstName']);
            $ad->setlastName($adopting['lastName']);
            $ad->setEmail($adopting['email']);
            //hash le mot de passe
            $pwd = $this->hasher->hashPassword($ad, $adopting['password']);
            $ad->setpassword($pwd);
//            permet de mettre le premier adoptant de la list ene admin
            if (0 == $i) {
                $ad->setIsAdministrator(true);
            }
            $ad->setcity($cities[$i]);
            ++$i;
            $manager->persist($ad);
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
