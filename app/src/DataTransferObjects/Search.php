<?php

namespace App\DataTransferObjects;

class Search
{
    private ?string $type = null;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $currency
     * @return Search
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }
}