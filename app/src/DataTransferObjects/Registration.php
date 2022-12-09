<?php

namespace App\DataTransferObjects;

class Registration
{
    private ?string $username = null;
    private ?string $password = null;


    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return Registration
     */
    public function setUsername(?string $username): Registration
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return Registration
     */
    public function setPassword(?string $password): Registration
    {
        $this->password = $password;
        return $this;
    }


}