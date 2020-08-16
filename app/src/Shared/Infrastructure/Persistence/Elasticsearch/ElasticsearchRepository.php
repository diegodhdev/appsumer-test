<?php

declare(strict_types=1);

namespace Base\Shared\Infrastructure\Persistence\Elasticsearch;

use Base\Shared\Domain\Criteria\Criteria;
use Base\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use function Lambdish\Phunctional\get_in;
use function Lambdish\Phunctional\map;

abstract class ElasticsearchRepository
{
    private ElasticsearchClient $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    abstract protected function aggregateName(): string;

    public function searchByCriteria(Criteria $criteria): array
    {
        $converter = new ElasticsearchCriteriaConverter();

        $query = $converter->convert($criteria);

        return $this->searchRawElasticsearchQuery($query);
    }

    protected function persist(string $id, array $plainBody): void
    {
        $this->client->persist($this->aggregateName(), $id, $plainBody);
    }

    protected function searchAllInElastic(): array
    {
        return $this->searchRawElasticsearchQuery([]);
    }

    protected function searchRawElasticsearchQuery(array $params): array
    {
        try {
            $result = $this->client->client()->search(array_merge(['index' => $this->indexName()], $params));

            $hits = get_in(['hits', 'hits'], $result, []);

            return map($this->elasticValuesExtractor(), $hits);
        } catch (Missing404Exception $unused) {
            return [];
        }
    }

    protected function indexName(): string
    {
        return sprintf('%s_%s', $this->client->indexPrefix(), $this->aggregateName());
    }

    private function elasticValuesExtractor(): callable
    {
        return static fn(array $elasticValues): array => $elasticValues['_source'];
    }
}
