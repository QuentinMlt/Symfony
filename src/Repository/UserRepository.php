<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function loginUser($email, $password):Query
    {
        return $this->createQueryBuilder('user')
                    ->select('user')
                    ->where("user.email = '$email'")
                    ->andWhere("user.password = '$password'")
                    ->getQuery();
    }

    public function rankUsers():Query
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.score', 'DESC')
            ->getQuery()
        ;
    }
    public function updateUser($id, $data):Query
    {
        if ($data['password'] === null) {
            return $this->createQueryBuilder('user')
                        ->update('user', 'u')
                        ->set('u.nom', '"'.$data['nom'].'"')
                        ->set('u.prenom', '"'.$data['prenom'].'"')
                        ->where("u.id = '$id'")
                        ->getQuery();
        }
        return $this->createQueryBuilder('user')
                    ->update('user', 'u')
                    ->set('u.nom', '"'.$data['nom'].'"')
                    ->set('u.prenom', '"'.$data['prenom'].'"')
                    ->set('u.password', '"'.$data['password'].'"')
                    ->where("u.id = '$id'")
                    ->getQuery();
    }

    public function updateScore($id, UserRepository $userRepository):Query
    {
        $user = $userRepository->find($id);

        if ($user->getScore() == 9) {
            return $this->createQueryBuilder('user')
            ->update('user', 'u')
            ->set('u.score', $user->getScore() + 1)
            ->set('u.ladder', "Argent" )
            ->where("u.id = '$id'")
            ->getQuery()
        ;
        }
        else if ($user->getScore() == 19) {
            return $this->createQueryBuilder('user')
            ->update('user', 'u')
            ->set('u.score', $user->getScore() + 1)
            ->set('u.ladder', "Or" )
            ->where("u.id = '$id'")
            ->getQuery()
        ;
        }
        else
        {
            return $this->createQueryBuilder('user')
            ->update('user', 'u')
            ->set('u.score', $user->getScore() + 1)
            ->where("u.id = '$id'")
            ->getQuery()
        ;
        }
        
    }
    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
