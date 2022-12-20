<?php

namespace App\Service;


use App\Repository\UserCartRepository;
use App\Util\OrderStatusUtil;


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
        $lastCart->setStatus(OrderStatusUtil::ORDER_STATUS[2]);
        $this->userCartRepository->save($lastCart);

    }
}

