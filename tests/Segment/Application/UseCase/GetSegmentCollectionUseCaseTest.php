<?php

declare(strict_types=1);

namespace App\Tests\Segment\Application\UseCase;

use App\Segment\Application\UseCase\GetSegmentCollectionUseCase;
use App\Segment\Domain\Repository\SegmentRepositoryInterface;
use App\Segment\Domain\SegmentCollection;
use App\Tests\Segment\Domain\SegmentCollectionMotherObject;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetSegmentCollectionUseCaseTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    private function mockSegmentRepositoryInterface(
        string $origin, 
        string $destination, 
        string $date,
        SegmentCollection $result
        ): SegmentRepositoryInterface {
            return Mockery::mock(
                SegmentRepositoryInterface::class, 
                function ($mock) use ($origin, $destination, $date) {
                    $mock->shouldReceive('getAll')
                        ->once()
                        ->with($origin, $destination, $date)
                        ->andReturn($result ?? SegmentCollectionMotherObject::buildDefault());
            });
    }

    public function testValidGetSegmentCollectionUseCaseExecute(): void
    {
        // Given
        $origin = 'MAD';
        $destination = 'BCN';
        $date = '2021-01-01';
        $collections = SegmentCollectionMotherObject::buildDefault();

        $segmentRepository = $this->mockSegmentRepositoryInterface(
            $origin, 
            $destination, 
            $date,
            SegmentCollectionMotherObject::buildDefault()
        );

        $sut = new GetSegmentCollectionUseCase($segmentRepository);

        //when

        $result = $sut->execute($origin, $destination, $date);

        // Then
        $this->assertEquals($collections, $result);
        $this->assertFalse($result->isEmpty());
    }

}