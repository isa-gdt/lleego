<?php

declare(strict_types=1);

namespace App\Segment\Domain;

use App\Common\Domain\Collection;
use DateTimeImmutable;

class SegmentCollection extends Collection
{
    public static function buildFromRaw(
        array $rawSegments
    ): self
    {
      $segments = [];
      foreach ($rawSegments as $rawSegment) {
        $start = $rawSegment->Departure->Date->__toString() . ' ' . $rawSegment->Departure->Time->__toString();
        $segments[] = new Segment(
            originCode: $rawSegment->Departure->AirportCode->__toString(),
            originName: $rawSegment->Departure->AirportName->__toString(),
            destinationCode: $rawSegment->Arrival->AirportCode->__toString(),
            destinationName: $rawSegment->Arrival->AirportName->__toString(),
            start: new DateTimeImmutable($start),
            end: new DateTimeImmutable($rawSegment->Arrival->Date->__toString()),
            transportNumber: $rawSegment->MarketingCarrier->FlightNumber->__toString(),
            companyCode: $rawSegment->MarketingCarrier->AirlineID->__toString(),
            companyName: $rawSegment->MarketingCarrier->Name->__toString(),
        );
      }

      return new self($segments);
    }    
}