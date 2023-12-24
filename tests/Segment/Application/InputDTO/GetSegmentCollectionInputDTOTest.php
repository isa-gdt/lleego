<?php

declare(strict_types=1);

namespace App\Tests\Segment\Application\InputDTO;

use App\Segment\Application\InputDTO\Segment\GetSegmentCollectionInputDTO;
use App\Segment\Infrastructure\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class GetSegmentCollectionInputDTOTest extends TestCase
{
    public function testCreateGetSegmentCollectionInputDTO(): void
    {
        // Given
        $data = [
            'origin' => 'MAD',
            'destination' => 'BCN',
            'date' => '2021-01-01',
        ];
        
        // When
        $dto = new GetSegmentCollectionInputDTO($data);

        // Then
        $this->assertEquals($data['origin'], $dto->getOrigin());
        $this->assertEquals($data['destination'], $dto->getDestination());
        $this->assertEquals($data['date'], $dto->getDate());
    }

    public function testCreateGetSegmentCollectionInputDTOValidationError(): void
    {
        // Given
        $data = [
            'origin' => '',
            'destination' => '',
            'date' => '',
        ];

        // Then
        $this->expectException(ValidationException::class);

        // When
        try  {
            $dto = new GetSegmentCollectionInputDTO($data);
        } catch (ValidationException $e) {
            $this->assertEquals([
                '[origin]' => 'This value should not be blank.',
                '[destination]' => 'This value should not be blank.',
                '[date]' => 'This value should not be blank.',
            ], $e->getErrors());
            $this->assertEquals('Validation error', $e->getMessage());
            throw $e;
        }
        
    }
    
}

