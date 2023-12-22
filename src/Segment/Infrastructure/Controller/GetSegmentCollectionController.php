<?php

declare (strict_types = 1);

namespace App\Segment\Infrastructure\Controller;

use App\Segment\Application\InputDTO\Segment\GetSegmentCollectionInputDTO;
use App\Segment\Application\GetSegmentCollectionUseCase;
use App\Segment\Infrastructure\Transformer\SegmentCollectionTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetSegmentCollectionController extends AbstractController
{

    public function __construct(
        private readonly GetSegmentCollectionUseCase $useCase,
        private readonly SegmentCollectionTransformer $transformer
    )
    {
    }

    public function __invoke(Request $request)
    {
        $dto = new GetSegmentCollectionInputDTO($request->query->all());

        $segments = $this->useCase->execute(
            $dto->getOrigin(),
            $dto->getDestination(),
            $dto->getDate()
        );

        $response = $this->transformer->transform($segments);

        return $this->json($response);
    }
}