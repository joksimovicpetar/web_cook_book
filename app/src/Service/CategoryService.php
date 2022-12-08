<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    function findCategories(){
        return $this->categoryRepository->findCategories();
    }

    function find($id){
        return $this->categoryRepository->find($id);
    }
}
