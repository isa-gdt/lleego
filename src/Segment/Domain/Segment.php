<?php

declare(strict_types=1);

namespace App\Segment\Domain;

use DateTimeImmutable;

class Segment
{
    public function __construct(
        private string $originCode,
        private string $originName,
        private string $destinationCode,
        private string $destinationName,
        private DateTimeImmutable $start,
        private DateTimeImmutable $end,
        private string $transportNumber,
        private string $companyCode,
        private string $companyName,
    )
    {
    }

    public function getOriginCode(): string
    {
        return $this->originCode;
    }

    public function getOriginName(): string
    {
        return $this->originName;
    }

    public function getDestinationCode(): string
    {
        return $this->destinationCode;
    }

    public function getDestinationName(): string
    {
        return $this->destinationName;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }

    public function getTransportNumber(): string
    {
        return $this->transportNumber;
    }

    public function getCompanyCode(): string
    {
        return $this->companyCode;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function toArray(): array
    {
        return [
            'originCode' => $this->originCode,
            'originName' => $this->originName,
            'destinationCode' => $this->destinationCode,
            'destinationName' => $this->destinationName,
            'start' => $this->start->format('Y-m-d H:i:s'),
            'end' => $this->end->format('Y-m-d H:i:s'),
            'transportNumber' => $this->transportNumber,
            'companyCode' => $this->companyCode,
            'companyName' => $this->companyName,
        ];
    }
}