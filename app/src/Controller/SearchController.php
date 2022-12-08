<?php

namespace App\Controller;

use SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarDumper\VarDumper;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(SearchType $searchType): Response
    {
        if ($searchType->getType()==1) {
            $render = $this->renderView('main/tag-search.html.twig');
        } else {
            $render = $this->render('search/index.html.twig');
        }

        return new JsonResponse(['html' => $render]);
    }
}
