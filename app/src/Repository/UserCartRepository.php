<?php

namespace App\Repository;

use App\Entity\UserCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<UserCart>
 *
 * @method UserCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCart[]    findAll()
 * @method UserCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCartRepository extends ServiceEntityRepository
{
    private Security $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, UserCart::class);
        $this->security = $security;
    }

    public function save(UserCart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserCart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLastActiveCart()
    {
        $user = $this->security->getUser()->getId();

        return $this->createQueryBuilder('user_cart')
            ->select('user_cart','user')
            ->leftJoin('user_cart.user', 'user')
            ->orderBy('user_cart.id', 'DESC')
            ->setParameter('user_check', $user)
            ->where('user.id LIKE :user_check')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return UserCart[] Returns an array of UserCart objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCart
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
