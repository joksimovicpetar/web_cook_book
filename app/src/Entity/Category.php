<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: RecipeCategories::class)]
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


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $recipeCategory->setCategory($this);
        }

        return $this;
    }

    public function removeRecipeCategory(RecipeCategories $recipeCategory): self
    {
        if ($this->recipeCategories->removeElement($recipeCategory)) {
            // set the owning side to null (unless already changed)
            if ($recipeCategory->getCategory() === $this) {
                $recipeCategory->setCategory(null);
            }
        }

        return $this;
    }
}
