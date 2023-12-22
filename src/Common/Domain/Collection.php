<?php

declare(strict_types=1);

namespace App\Common\Domain;

class Collection 
{
    public function __construct(protected array $collection)
    {
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}