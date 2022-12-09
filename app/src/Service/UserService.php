<?php

namespace App\Service;

use App\Factory\RegisterUserFactory;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserService
{
    private $repository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $repository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->repository = $repository;
        $this->passwordHasher = $passwordHasher;
    }

    function save($user)
    {
        $this->repository->save($user);
    }

    function update($user)
    {
        $this->repository->update($user);
    }

    function delete($user)
    {
        $this->repository->delete($user);
    }

    function find($id){
        return $this->repository->find($id);
    }

    function write($dataObjectRegistration){
        $user = RegisterUserFactory::registerUserFromParams($dataObjectRegistration);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dataObjectRegistration->getPassword()
        );
        $user->setPassword($hashedPassword);
        $this->repository->save($user);
    }

}
