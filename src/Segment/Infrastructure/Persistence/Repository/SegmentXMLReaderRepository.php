<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Persistence\Repository;

use App\Common\Infrastructure\Services\XMLReaderService;
use App\Segment\Domain\Repository\SegmentRepositoryInterface;
use App\Segment\Domain\SegmentCollection;
use Exception;
use RuntimeException;
use SebastianBergmann\Environment\Runtime;

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
        //fixme: mejorar esto, esto es un poco chapuza.
        $xpath = sprintf(
            "//ns:AirShoppingRS/ns:DataLists/ns:FlightSegmentList/ns:FlightSegment[ns:Departure/ns:AirportCode = '%s' and ns:Arrival/ns:AirportCode = '%s' and ns:Departure/ns:Date = '%s']",
            $origin,
            $destination,
            $date
        );

        try {
            $rawSegments = $this->xmlReaderService->read(self::URL, $xpath);
        } catch (Exception $e) {
            throw new RuntimeException('Error reading XML file');
        }
      
        return SegmentCollection::buildFromRaw($rawSegments);
    }
}