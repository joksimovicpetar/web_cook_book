<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\VarDumper\VarDumper;

class TagsAppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://tasty.p.rapidapi.com/tags/list",
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
        $tags = $response->results;
        foreach ($tags as $tag) {

            $newCategory = new Category();
            $newCategory -> setId($tag->id);
            $newCategory -> setName($tag->display_name);
            $newCategory -> setType($tag->type);

            $manager->persist($newCategory);
        }

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $manager->flush();
    }
}