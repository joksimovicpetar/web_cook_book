<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Entity\RecipeCategories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\VarDumper\VarDumper;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://tasty.p.rapidapi.com/recipes/list?from=0&size=200",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: tasty.p.rapidapi.com",
                "X-RapidAPI-Key: f11c28e20bmsh526898fc11b7fe6p1f3985jsnc6aabd6c4b42"
            ],
        ]);

        $response = json_decode(curl_exec($curl));
        $recipes = $response->results;
        foreach ($recipes as $recipe) {
            $newRecipe = new Recipe();
            $newRecipe -> setId($recipe->id);
            $newRecipe -> setName($recipe->name);
            $newRecipe -> setDescription($recipe->description);
            $newRecipe -> setImage($recipe->thumbnail_url);
            $manager->persist($newRecipe);

//            $tags = $recipe->tags;
//            foreach ($tags as $tag){
//                $newRecipeCategories = new RecipeCategories($recipe->id, $tag->id);
//                $manager->persist($newRecipeCategories);
//            }
        }

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $manager->flush();
    }
}