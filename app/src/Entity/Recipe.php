<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeCategories::class)]
    private Collection $recipeCategories;

    public function __construct()
    {
        $this->recipeCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


    public function getRecipeCategories(): ?RecipeCategories
    {
        return $this->recipeCategories;
    }

    public function setRecipeCategories(?RecipeCategories $recipeCategories): self
    {
        $this->recipeCategories = $recipeCategories;

        return $this;
    }

    public function addRecipeCategory(RecipeCategories $recipeCategory): self
    {
        if (!$this->recipeCategories->contains($recipeCategory)) {
            $this->recipeCategories->add($recipeCategory);
            $recipeCategory->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeCategory(RecipeCategories $recipeCategory): self
    {
        if ($this->recipeCategories->removeElement($recipeCategory)) {
            // set the owning side to null (unless already changed)
            if ($recipeCategory->getRecipe() === $this) {
                $recipeCategory->setRecipe(null);
            }
        }

        return $this;
    }
}
