<?php

namespace App\Services;

use Illuminate\Support\Str;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AggregateService
{
    public function store(AggregateRoot $aggregate, array $params, string $method): void
    {
        $instance = $aggregate::retrieve(Str::uuid());
        $instance->$method($params);
        $instance->persist();
    }

    public function update(AggregateRoot $aggregate, array $params, int $id): void
    {
        $aggregate::retrieve($id)->update($params)->persist();
    }
}
