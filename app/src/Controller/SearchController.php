<?php

namespace App\Controller;

use App\DataTransferObjects\Search;
use App\DataTransferObjects\SearchCategory;
use App\Service\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarDumper\VarDumper;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Search $search): Response
    {
//        VarDumper::dump($search);exit;
        if ($search->getType()==1) {
            $render = $this->renderView('main/tag-search.html.twig');
        } else {
            $render = $this->render('search/index.html.twig');
        }

        return new JsonResponse(['html' => $render]);
    }

    #[Route('/search_category', name: 'app_search_category')]
    public function search(SearchCategory $searchCategory, RecipeService $recipeService): Response
    {
        $recipes = $recipeService->findRecipesForSpecificCategory($searchCategory);

        $render = $this->renderView('main/recipes-list.html.twig', [
            'recipes' => $recipes
        ]);
        return new JsonResponse(['html' => $render]);
    }
}
