<?php

declare(strict_types=1);

namespace App\Common\Domain;

use App\Segment\Domain\Segment;

class Collection 
{
    public function __construct(protected array $collection)
    {
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function toArray(): array
    {
        return array_map(function (Segment $collection) {
            return $collection->toArray();
        }, $this->collection);
    }

    public function isEmpty(): bool
    {
        return empty($this->collection);
    }
}