<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Persistence\Repository;

use App\Common\Infrastructure\Services\XMLReaderService;
use App\Segment\Domain\Repository\SegmentRepositoryInterface;
use App\Segment\Domain\SegmentCollection;

class SegmentXMLReaderRepository implements SegmentRepositoryInterface
{
    private const URL = 'https://testapi.lleego.com/prueba-tecnica/availability-price-without-soap';

    public function __construct(
        private readonly XMLReaderService $xmlReaderService
    )
    {
    }

    public function getAll(string $origin, string $destination, string $date): SegmentCollection 
    {
        //fixme: esto es un poco chapuza.
        $xpath = sprintf(
            "//ns:AirShoppingRS/ns:DataLists/ns:FlightSegmentList/ns:FlightSegment[ns:Departure/ns:AirportCode = '%s' and ns:Arrival/ns:AirportCode = '%s' and ns:Departure/ns:Date = '%s']",
            $origin,
            $destination,
            $date
        );

        $rawSegments = $this->xmlReaderService->read(self::URL, $xpath);

        if (empty($rawSegments)) {
            die('The data was not found.');
        }

        return SegmentCollection::buildFromRaw($rawSegments);
    }
}