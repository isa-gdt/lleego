<?php

declare(strict_types=1);

namespace App\Tests\Segment\Domain;

use App\Segment\Domain\SegmentCollection;

class SegmentCollectionMotherObject
{
    public static function buildDefault(int $totalElements =1): SegmentCollection
    {
        $collections = [];
        for ($i = 0; $i < $totalElements; $i++) {
            $collections[] = SegmentMotherObject::buildDefault();
        }

        return new SegmentCollection($collections);
    }
}