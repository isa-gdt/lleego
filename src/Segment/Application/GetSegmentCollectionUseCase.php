<?php

declare(strict_types=1);

namespace App\Segment\Application;

use App\Segment\Domain\Repository\SegmentRepositoryInterface;
use App\Segment\Domain\SegmentCollection;

// Equivalente en la prueba técnica al caso de uso availabilityPrice
class GetSegmentCollectionUseCase
{

    public function __construct(
        private readonly SegmentRepositoryInterface $segmentRepository
    )
    {
    }

    public function execute(
        string $origin,
        string $destination,
        string $date
    ): SegmentCollection
    {
        $segments = $this->segmentRepository->getAll(
            $origin,
            $destination,
            $date
        );

        return $segments;
    }
}