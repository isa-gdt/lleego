<?php

declare(strict_types=1);

namespace App\Segment\Domain\Repository;

use App\Segment\Domain\SegmentCollection;

interface SegmentRepositoryInterface
{
    public function getAll(string $origin, string $destination, string $date):SegmentCollection;
}