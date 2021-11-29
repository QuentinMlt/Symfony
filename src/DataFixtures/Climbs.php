<?php

namespace App\DataFixtures;

use App\Entity\Climb;
use App\Entity\User;
use DateTime;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Climbs extends Fixture
{
    private static $rank = [
        'Bronze',
        'Argent',
        'Or',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker =  Factory::create('fr_FR');

        $user = new User();
        $user
            ->setNom("User-nom")
            ->setEmail("user@test.com")
            ->setScore(random_int(0,9))
            ->setLadder("Bronze")
            ->setPrenom("User-prenom")
            ->setPassword('$13$W2HxDkChc/bGBc8FoyyOH.2u46J/2QgtR33ULtQwL.BFhDeeVgKQW')
            ->setRoles(['ROLE_USER'])
        ;

        $manager->persist($user);

        for ($i = 0; $i < 10; $i++)
        {  
            
            $entity = new Climb();
            $entity
                ->setNom($faker->sentence(7))
                ->setDescription($faker->sentence(100))
                ->setDate(new \DateTime())
                ->setLocalisation('10 rue de la mere de Lucas')
                ->setRequireRank($faker->randomElement(self::$rank))
                ->setUser($user)
                ->setMaxUser(10)
                ->setImage('https://image.shutterstock.com/image-vector/no-image-vector-isolated-on-600w-1481369594.jpg')
            ;
            $manager->persist($entity);
            
        }

        $manager->flush();
    }
}
