<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseQuery
{
    public function query(): Collection|array ;

    public function find(int $id): Model|null;
}
