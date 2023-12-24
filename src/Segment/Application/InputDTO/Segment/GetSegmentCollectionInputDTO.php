<?php

declare(strict_types=1);

namespace App\Segment\Application\InputDTO\Segment;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use App\Segment\Infrastructure\Exception\ValidationException;

class GetSegmentCollectionInputDTO
{
    private string $origin;
    private string $destination;
    private string $date;

    public function __construct(array $data) 
    {
        $this->validate($data);
        $this->origin = $data['origin'];
        $this->destination = $data['destination'];
        $this->date = $data['date'];
    }

    /**
     * @throws ValidationException
     */
    private function validate(array $data): void
    {
        $validator = Validation::createValidator();
        $rules = new Assert\Collection([
            'fields' => [
                'origin' => new Assert\NotBlank(),
                'destination' => new Assert\NotBlank(),
                'date' => new Assert\NotBlank(),
            ],
            'allowExtraFields' => true,
        ]);

        $violations = $validator->validate($data, $rules);

        if(count($violations) > 0) {
            $errorMessages = [];
            foreach ($violations as $violation) {
                $errorMessages[$violation->getPropertyPath()] = $violation->getMessage();
            }
            throw new ValidationException($errorMessages);
        }
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}