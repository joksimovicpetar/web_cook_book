<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @extends ServiceEntityRepository<Recipe>
 *
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function save(Recipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findRecipesForSpecificCategory($searchCategory, $offset, $page){
        $firstResult = ($page-1)*$offset;
        return $this->createQueryBuilder('recipe')
            ->select('recipe','recipeCategories', 'category')
            ->leftJoin('recipe.recipeCategories', 'recipeCategories')
            ->leftJoin('recipeCategories.category', 'category')
            ->orderBy('recipe.id', 'DESC')
            ->setParameter('name_of_category', $searchCategory)
            ->where('category.name LIKE :name_of_category')
            ->setFirstResult($firstResult)
            ->setMaxResults($offset)
            ->getQuery()
            ->getResult();

    }

    public function findSearchedRecipes($searchParameter){
        return $this->createQueryBuilder('recipe')
            ->select('recipe')
            ->orderBy('recipe.id', 'DESC')
            ->setParameter('search_parameter', '%'.$searchParameter.'%')
            ->where('recipe.name LIKE :search_parameter')
            ->getQuery()
            ->getResult();

    }


//    /**
//     * @return Recipe[] Returns an array of Recipe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recipe
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
