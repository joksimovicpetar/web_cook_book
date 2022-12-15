<?php

namespace App\Entity;

use App\Repository\UserCartRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCartRecipeRepository::class)]
class UserCartRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'UserCart', cascade: ['persist', 'remove'],inversedBy: 'userCartRecipes'),
    ORM\JoinColumn(name: 'user_cart_id', referencedColumnName: 'id')]
    private ?UserCart $userCart = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'], inversedBy: 'userCartRecipes'),
    ORM\JoinColumn(name: 'recipe_id', referencedColumnName: 'id')]
    private ?Recipe $recipe = null;

    /**
     * @param UserCart|null $userCart
     * @param Recipe|null $recipe
     */
    public function __construct(?UserCart $userCart, ?Recipe $recipe)
    {
        $this->userCart = $userCart;
        $this->recipe = $recipe;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserCart(): ?UserCart
    {
        return $this->userCart;
    }

    public function setUserCart(?UserCart $userCart): self
    {
        $this->userCart = $userCart;

        return $this;
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
}
