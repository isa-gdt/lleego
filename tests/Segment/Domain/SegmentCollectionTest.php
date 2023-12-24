<?php

declare(strict_types=1);

namespace App\Tests\Segment\Domain;

use App\Segment\Domain\SegmentCollection;
use PHPUnit\Framework\TestCase;

class SegmentCollectionTest extends TestCase
{
    public function testCreateSegmentCollection(): void
    {

        $segmentCollection = SegmentCollectionMotherObject::buildDefault();

        $this->assertCount(1, $segmentCollection->toArray());

        $this->assertEquals([
            [
                'originCode' => 'MAD',
                'originName' => 'Madrid',
                'destinationCode' => 'BCN',
                'destinationName' => 'Barcelona',
                'start' => '2021-01-01 00:00:00',
                'end' => '2021-01-01 01:00:00',
                'transportNumber' => '1234',
                'companyCode' => 'ALSA',
                'companyName' => 'ALSA',
            ]
        ], $segmentCollection->toArray());
    }

    public function testBuildFromRaw():void{

        $xmlStrings = [
            '<Segment SegmentKey="IB042620220601MADBIO">
                <Departure>
                    <AirportCode>MAD</AirportCode>
                    <Date>2021-01-01 00:00:00</Date>
                    <AirportName>Madrid</AirportName>
                </Departure>
                <Arrival>
                    <AirportCode>BCN</AirportCode>
                    <Date>2021-01-01 01:00:00</Date>
                    <ChangeOfDay>0</ChangeOfDay>
                    <AirportName>Barcelona</AirportName>
                </Arrival>
                <MarketingCarrier>
                    <AirlineID>ALSA</AirlineID>
                    <Name>ALSA</Name>
                    <FlightNumber>1234</FlightNumber>
                </MarketingCarrier>
            </Segment>'
        ];

        $rawSegments = [];
        foreach ($xmlStrings as $xmlString) {
            $rawSegments[] = simplexml_load_string($xmlString);
        }

        $segmentCollection = SegmentCollection::buildFromRaw($rawSegments);

        $this->assertCount(1, $segmentCollection->toArray());
        $this->assertEquals([
            [
                'originCode' => 'MAD',
                'originName' => 'Madrid',
                'destinationCode' => 'BCN',
                'destinationName' => 'Barcelona',
                'start' => '2021-01-01 00:00:00',
                'end' => '2021-01-01 01:00:00',
                'transportNumber' => '1234',
                'companyCode' => 'ALSA',
                'companyName' => 'ALSA',
            ]
        ], $segmentCollection->toArray());

        $this->assertIsArray($segmentCollection->getCollection());
    }
}