<?php

namespace App\Projections;

use App\Enums\CarStatus;
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => CarStatus::class,
    ];

    protected $fillable = ['uuid', 'make', 'model', 'status'];

    public function events(): HasMany
    {
        return $this->hasMany(CarEvent::class);
    }

    public function changeStatus(CarStatus $status): void
    {
        $this->status = $status->value;
    }
}
