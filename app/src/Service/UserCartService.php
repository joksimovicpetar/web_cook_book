<?php

namespace App\Service;


use App\Repository\UserCartRepository;


class UserCartService
{
    private UserCartRepository $userCartRepository;

    public function __construct(UserCartRepository $userCartRepository)
    {
        $this->userCartRepository = $userCartRepository;
    }

    function find($id){
        return $this->userCartRepository->find($id);
    }

    function findLastActiveCart(){
        return $this->userCartRepository->findLastActiveCart();
    }

    public function completeOrder()
    {
        $lastCart = $this->findLastActiveCart();
        $lastCart->setStatus('completed');
        $this->userCartRepository->save($lastCart);

    }
}

