<?php

declare(strict_types=1);

namespace App\Tests\Segment\Domain;

use App\Segment\Domain\Segment;
use DateTimeImmutable;

class SegmentMotherObject
{
    public static function buildDefault(): Segment
    {
        return new Segment(
            originCode: 'MAD',
            originName: 'Madrid',
            destinationCode: 'BCN',
            destinationName: 'Barcelona',
            start: new DateTimeImmutable('2021-01-01 00:00:00'),
            end: new DateTimeImmutable('2021-01-01 01:00:00'),
            transportNumber: '1234',
            companyCode: 'ALSA',
            companyName: 'ALSA',
        );
    }
}