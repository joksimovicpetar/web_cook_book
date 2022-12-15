<?php

namespace App\Repository;

use App\Entity\UserCartRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCartRecipe>
 *
 * @method UserCartRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCartRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCartRecipe[]    findAll()
 * @method UserCartRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCartRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCartRecipe::class);
    }

    public function save(UserCartRecipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

    }

    public function remove(UserCartRecipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findRecipesInCart($lastCart){
        return $this->createQueryBuilder('user_cart_recipe')
            ->select('user_cart_recipe', 'userCart')
            ->leftJoin('user_cart_recipe.userCart', 'userCart')
            ->orderBy('user_cart_recipe.id', 'DESC')
            ->setParameter('id_check', $lastCart->getId())
            ->setParameter('status_check', 'active')
            ->where('userCart.id LIKE :id_check')
            ->andWhere('userCart.status LIKE :status_check')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return UserCartRecipe[] Returns an array of UserCartRecipe objects
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

//    public function findOneBySomeField($value): ?UserCartRecipe
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
