<?php

namespace App\Projections;

use App\Models\CarEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EventSourcing\Projections\Projection;

class Car extends Projection
{
    use HasFactory;

    public function isWriteable(): bool
    {
        return true;
    }

    protected $guarded = [];
    protected $fillable = ['uuid', 'make', 'model', 'status'];

    public function events(): HasMany
    {
        return $this->hasMany(CarEvent::class);
    }

    public function changeStatus($status): void
    {
        $this->status = $status;
    }
}
