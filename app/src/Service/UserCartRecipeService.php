<?php

namespace App\Service;

use App\Entity\UserCart;
use App\Entity\UserCartRecipe;
use App\Repository\UserCartRecipeRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\VarDumper\VarDumper;


class UserCartRecipeService
{
    private UserCartRecipeRepository $userCartRecipeRepository;
    private Security $security;
    private RecipeService $recipeService;
    private UserCartService $userCartService;

    public function __construct(
        UserCartRecipeRepository $userCartRecipeRepository,
        Security $security,
        RecipeService $recipeService,
        UserCartService $userCartService
    )
    {
        $this->userCartRecipeRepository = $userCartRecipeRepository;
        $this->security = $security;
        $this->recipeService = $recipeService;
        $this->userCartService = $userCartService;
    }

    function find($id){
        return $this->userCartRecipeRepository->find($id);
    }

    public function addToCart($id)
    {
        $recipe = $this->recipeService->find($id);
        $user = $this->security->getUser();
        $lastCart = $this->userCartService->findLastActiveCart();
//        VarDumper::dump($recipe);
//        VarDumper::dump($user);
//        VarDumper::dump($lastCart);exit;


        if ($lastCart == null || $lastCart->getStatus() == 'completed'){
            $cart = new UserCart($user,'active');
            $userCartRecipeRepository = new UserCartRecipe($cart,$recipe);
            $this->userCartRecipeRepository->save($userCartRecipeRepository);
        } else {
            $userCartRecipeRepository = new UserCartRecipe($lastCart,$recipe);
            $this->userCartRecipeRepository->save($userCartRecipeRepository);
        }

    }
}
