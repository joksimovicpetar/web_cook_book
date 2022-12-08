<?php

namespace App\Service;

use App\Repository\RecipeRepository;

class RecipeService
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    function find($id){
        return $this->recipeRepository->find($id);
    }

    function findRecipesForSpecificCategory($searchCategory, $offset = 3, $page = 1){
        return $this->recipeRepository->findRecipesForSpecificCategory($searchCategory, $offset, $page);
    }

}
