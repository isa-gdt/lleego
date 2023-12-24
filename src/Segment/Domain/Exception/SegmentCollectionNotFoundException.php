<?php

declare(strict_types=1);

namespace App\Segment\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SegmentCollectionNotFoundException extends NotFoundHttpException
{
    protected const MESSAGE = 'Segment Collection not found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}