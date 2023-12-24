<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Command;

use App\Segment\Application\UseCase\GetSegmentCollectionUseCase;
use App\Segment\Application\InputDTO\Segment\GetSegmentCollectionInputDTO;
use App\Segment\Infrastructure\Transformer\SegmentCollectionTransformer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'lleego:avail',
    description: 'Get segment collection'
)]
class GetSegmentCollectionCommand extends Command
{
    public function __construct(
        private readonly GetSegmentCollectionUseCase $useCase,
        private readonly SegmentCollectionTransformer $transformer
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('origin', InputArgument::REQUIRED, 'Origin code')
            ->addArgument('destination', InputArgument::REQUIRED, 'Destination code')
            ->addArgument('date', InputArgument::REQUIRED, 'date');
    }

    protected function execute (InputInterface $input, OutputInterface $output):int
    {
        $dto = new GetSegmentCollectionInputDTO($input->getArguments());

        $segments = $this->useCase->execute(
            $dto->getOrigin(),
            $dto->getDestination(),
            $dto->getDate()
        );

        if ($segments->isEmpty()){
            $output->writeln('Not Segment Collection Found');
            return Command::FAILURE;
        }

        $response = $this->transformer->transform($segments);

        $this->createTableOutput($output, $response);
        return Command::SUCCESS;
    }

    private function createTableOutput(OutputInterface $output, array $response): void
    {
        $table = new Table($output);

        $table->setHeaders(['Origin Code', 'Origin Name', 'Destination Code', 'Destination Name', 'Start', 'End', 'Transport Number', 'CompanyCode', 'Company Name'])
        ->setRows($response);

        $table->render();
    }
}
