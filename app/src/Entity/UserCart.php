<?php

namespace App\Entity;

use App\Repository\UserCartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCartRepository::class)]
class UserCart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'User',inversedBy: 'userCarts'),
    ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'userCart', targetEntity: UserCartRecipe::class)]
    private Collection $userCartRecipes;

    public function __construct()
    {
        $this->userCartRecipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, UserCartRecipe>
     */
    public function getUserCartRecipes(): Collection
    {
        return $this->userCartRecipes;
    }

    public function addUserCartRecipe(UserCartRecipe $userCartRecipe): self
    {
        if (!$this->userCartRecipes->contains($userCartRecipe)) {
            $this->userCartRecipes->add($userCartRecipe);
            $userCartRecipe->setUserCart($this);
        }

        return $this;
    }

    public function removeUserCartRecipe(UserCartRecipe $userCartRecipe): self
    {
        if ($this->userCartRecipes->removeElement($userCartRecipe)) {
            // set the owning side to null (unless already changed)
            if ($userCartRecipe->getUserCart() === $this) {
                $userCartRecipe->setUserCart(null);
            }
        }

        return $this;
    }
}
