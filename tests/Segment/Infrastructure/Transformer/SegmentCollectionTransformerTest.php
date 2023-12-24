<?php

declare(strict_types=1);

namespace App\Tests\Segment\Infrastructure\Transformer;

use App\Segment\Infrastructure\Transformer\SegmentCollectionTransformer;
use App\Tests\Segment\Domain\SegmentCollectionMotherObject;
use PHPUnit\Framework\TestCase;

class SegmentCollectionTransformerTest extends TestCase
{
    public function testTransformSuccess(): void
    {
        // Given
        $segmentCollection = SegmentCollectionMotherObject::buildDefault();

        // When
        $sut = new SegmentCollectionTransformer();
        $result = $sut->transform($segmentCollection);

        // Then
        $this->assertEquals([
            [
                'originCode' => 'MAD',
                'originName' => 'Madrid',
                'destinationCode' => 'BCN',
                'destinationName' => 'Barcelona',
                'start' => '2021-01-01 00:00:00',
                'end' => '2021-01-01',
                'transportNumber' => '1234',
                'companyCode' => 'ALSA',
                'companyName' => 'ALSA',
            ]
        ], $result);
    }
}