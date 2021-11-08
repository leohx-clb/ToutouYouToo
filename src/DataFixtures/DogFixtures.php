<?php

namespace App\DataFixtures;

use App\Entity\Dog;
use App\Entity\Picture;
use App\Repository\PictureRepository;
use App\Repository\RaceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DogFixtures extends Fixture implements DependentFixtureInterface
{
    private RaceRepository $raceRepository;

    public function __construct(RaceRepository $raceRepository)
    {
        $this->raceRepository = $raceRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
//        $pictures = $this->pictureRepository->findAll();
        $races = $this->raceRepository->findAll();

        $urlPictures = [
            'https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1889&q=80',
            'https://images.unsplash.com/photo-1605725657590-b2cf0d31b1a5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1887&q=80',
            'https://images.unsplash.com/photo-1617895153857-82fe79adfcd4?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1887&q=80',
            'https://images.unsplash.com/photo-1509119993276-d691aff73209?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2073&q=80',
        ];

        $names = [
            'Urban',
            'Snoopy',
            'Dolly',
            'Sydney',
        ];

        $sexs = [
            'Male',
            'Male',
            'Femelle',
            'Femelle',
        ];

        foreach ($races as $key => $race) {
            $picture = new Picture();
            $picture->setUrl($urlPictures[$key]);

            $manager->persist($picture);

            $dog = new Dog();
            $dog->setName($names[$key]);
            $dog->setSex($sexs[$key]);
            $dog->setDescription('Lorem ipsum dolor sit amet, consectetur scing elit. Integer mollis lacus et imperdiet consequat.erat convallis posuere in sed ex. Nulla pulvinar est non acc');
            $dog->addPicture($picture);
            $dog->addRace($race);
            $dog->setAnimalsFriendly(true);
            $dog->setLof(true);

            $manager->persist($dog);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RaceFixtures::class,
        ];
    }
}
