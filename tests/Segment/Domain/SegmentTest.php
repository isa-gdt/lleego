<?php

declare(strict_types=1);

namespace App\Tests\Segment\Domain;

use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    public function testCreateSegment(): void
    {

        $segment = SegmentMotherObject::buildDefault();

        $this->assertEquals([
            'originCode' => 'MAD',
            'originName' => 'Madrid',
            'destinationCode' => 'BCN',
            'destinationName' => 'Barcelona',
            'start' => '2021-01-01 00:00:00',
            'end' => '2021-01-01 01:00:00',
            'transportNumber' => '1234',
            'companyCode' => 'ALSA',
            'companyName' => 'ALSA',
        ], $segment->toArray());

        $this->assertEquals('MAD', $segment->getOriginCode());
        $this->assertEquals('Madrid', $segment->getOriginName());
        $this->assertEquals('BCN', $segment->getDestinationCode());
        $this->assertEquals('Barcelona', $segment->getDestinationName());
        $this->assertEquals('2021-01-01 00:00:00', $segment->getStart()->format('Y-m-d H:i:s'));
        $this->assertEquals('2021-01-01 01:00:00', $segment->getEnd()->format('Y-m-d H:i:s'));
        $this->assertEquals('1234', $segment->getTransportNumber());
        $this->assertEquals('ALSA', $segment->getCompanyCode());
        $this->assertEquals('ALSA', $segment->getCompanyName());
    }
}