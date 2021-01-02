<?php

namespace App\Repository;

use App\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{

    public $password_encoder;
    private $manager ;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager,
                                UserPasswordEncoderInterface $password_encoder)
    {
        parent::__construct($registry, Participant::class);
        $this->manager = $manager;
        $this->password_encoder=$password_encoder;
    }


    public function saveUser($firstName,$lastName,$email,$password){
        $user = new Participant() ;

        $user->setPrenomP($firstName);
        $user->setNomP($lastName);
        $user->setEmail($email);
        $plan_Password=$password;
        $user->setPassword($this->password_encoder->encodePassword($user, $plan_Password));


        $this->manager-> persist($user);
        $this->manager->flush();

    }


    // /**
    //  * @return Participant[] Returns an array of Participant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Participant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
