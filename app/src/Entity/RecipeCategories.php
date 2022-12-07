<?php

namespace App\Entity;

use App\Repository\RecipeCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeCategoriesRepository::class)]
class RecipeCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Recipe', inversedBy: 'recipeCategories'),
    ORM\JoinColumn(name: 'recipe_id', referencedColumnName: 'id')]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(targetEntity: 'Category',inversedBy: 'recipeCategories'),
    ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ?Category $category = null;

    public function __construct(?Recipe $recipe, Category $category)
    {
        $this->recipe = $recipe;
        $this->category = $category;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


}
