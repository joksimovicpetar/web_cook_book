<?php

namespace App\Controller;

use App\DataTransferObjects\Search;
use App\DataTransferObjects\SearchCategory;
use App\Service\CategoryService;
use App\Service\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarDumper\VarDumper;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Search $search): Response
    {
        if ($search->getType()==1) {
            $render = $this->renderView('main/tag-search.html.twig');
        } else {
            $render = $this->renderView('main/search-bar.html.twig');
        }

        return new JsonResponse(['html' => $render]);
    }

    #[Route('/search_category', name: 'app_search_category')]
    public function search(SearchCategory $searchCategory, RecipeService $recipeService): Response
    {
        $recipes = $recipeService->findRecipesForSpecificCategory($searchCategory->getCategory());

        $render = $this->renderView('main/recipes-list.html.twig', [
            'recipes' => $recipes,
            'category'=> $searchCategory->getCategory()
        ]);
        return new JsonResponse(['html' => $render]);
    }

    #[Route('/load_more_category', name: 'app_load_more_category')]
    public function loadMore(Request $request, RecipeService $recipeService, CategoryService $categoryService): Response
    {
        $offset = json_decode($request->getContent())->offset;
        $page = json_decode($request->getContent())->page;
        $category = ($categoryService->findCategories(json_decode($request->getContent())->category)[0])->getName();

        $recipes = $recipeService->findRecipesForSpecificCategory($category, $offset, $page);

        $render = $this->renderView('main/recipes-list.html.twig', [
            'recipes' => $recipes,
            'category'=> $category
        ]);
        return new JsonResponse(['html' => $render, 'hasMoreResults' => count($recipes)==$offset]);
    }


    #[Route('/load_more_search', name: 'app_load_more_search')]
    public function loadMoreSearch(Request $request, RecipeService $recipeService): Response
    {
        $searchParameter = json_decode($request->getContent())->searchParameter;

        $recipes = $recipeService->findSearchedRecipes($searchParameter);
        $render = $this->renderView('main/recipes-list.html.twig', [
            'recipes' => $recipes
        ]);
        return new JsonResponse(['html' => $render]);
    }


    #[Route('/recipe_detail/{id}', name: 'app_modal')]
    public function modal(Request $request, RecipeService $recipeService, $id): Response
    {
        $recipeDetails = $recipeService->find($id);
        VarDumper::dump($recipeDetails);
        return $this->render('main/modal-content.html.twig', [
            'message' => 'Message'
        ]);
    }

}
