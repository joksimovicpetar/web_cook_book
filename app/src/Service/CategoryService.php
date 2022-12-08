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

    function findCategories($category){
        return $this->categoryRepository->findCategories($category);
    }

    function find($id){
        return $this->categoryRepository->find($id);
    }
}
