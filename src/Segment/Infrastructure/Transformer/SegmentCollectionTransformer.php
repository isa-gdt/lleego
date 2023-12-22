<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Transformer;

use App\Segment\Domain\SegmentCollection;

class SegmentCollectionTransformer
{
    public function transform (SegmentCollection $segmentCollection): array
    {
    
        $segments = array_map(function ($segment) {
            return [
                'originCode' => $segment->getOriginCode(),
                'originName' => $segment->getOriginName(),
                'destinationCode' => $segment->getDestinationCode(),
                'destinationName' => $segment->getDestinationName(),
                'start' => $segment->getStart()->format('Y-m-d H:i:s'),
                'end' => $segment->getEnd()->format('Y-m-d'),
                'transportNumber' => $segment->getTransportNumber(),
                'companyCode' => $segment->getCompanyCode(),
                'companyName' => $segment->getCompanyName(),
            ];
        }, $segmentCollection->getCollection());

        return $segments;
    }
}