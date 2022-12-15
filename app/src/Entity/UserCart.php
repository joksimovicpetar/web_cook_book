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

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @param User|null $user
     * @param string|null $status
     */
    public function __construct(?User $user, ?string $status)
    {
        $this->user = $user;
        $this->status = $status;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
