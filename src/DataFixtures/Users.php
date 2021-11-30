<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Users extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++)
        {
            $entity = new User();
            $entity
                ->setNom("User$i-nom")
                ->setEmail("user$i@test.com")
                ->setScore(random_int(0,9))
                ->setLadder("Bronze")
                ->setPrenom("User$i-prenom")
                ->setPassword('$2y$13$nSXkFbmZQoQlGQXQiIpkP.1bcXlIAqfKW7gE0h7iC6QE0mhRmLyyu')
                ->setRoles(["ROLE_USER"])
                ;

                $manager->persist($entity);
        }

        $manager->flush();
    }
}
