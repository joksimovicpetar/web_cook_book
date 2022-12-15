<?php

namespace App\Service;

use App\Repository\RecipeCategoriesRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Flex\Recipe;


class RecipeCategoriesService
{
    private RecipeCategoriesRepository $recipeCategoriesRepository;

    public function __construct(RecipeCategoriesRepository $recipeCategoriesRepository)
    {
        $this->recipeCategoriesRepository = $recipeCategoriesRepository;

    }

    function find($id){
        return $this->recipeCategoriesRepository->find($id);
    }
}
