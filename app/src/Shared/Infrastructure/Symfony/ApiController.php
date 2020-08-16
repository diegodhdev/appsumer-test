<?php

declare(strict_types=1);

namespace Base\Shared\Infrastructure\Symfony;

use Base\Shared\Domain\Bus\Command\Command;
use Base\Shared\Domain\Bus\Command\CommandBus;
use Base\Shared\Domain\Bus\Query\Query;
use Base\Shared\Domain\Bus\Query\QueryBus;
use Base\Shared\Domain\Bus\Query\Response;
use function Lambdish\Phunctional\each;

abstract class ApiController
{
    private QueryBus                           $queryBus;
    private CommandBus                         $commandBus;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        $this->queryBus   = $queryBus;
        $this->commandBus = $commandBus;

        each(
            fn(int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    protected function ask(Query $query): ?Response
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
