<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'mileage',
        'name',
        'brand',
        'engine_size',
        'color',
        'location',
        'seller_contact',
        'price'
    ];

    protected $sortable = [
        'price',
        'brand',
        'created_at'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'by_user_id'
        );
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->latest();
    }

    public function images(): HasMany {
        return $this->hasMany(ListingImage::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price', '>=', $value)
        )
            ->when(
                $filters['priceTo'] ?? false,
                fn($query, $value) => $query->where('price', '<=', $value)
            )
            ->when(
                $filters['brand'] ?? false,
                fn($query, $value) => $query->where('brand', $value)
            )
            ->when(
                $filters['engine'] ?? false,
                fn($query, $value) => $query->where('engine_size', $value)
            )
            ->when(
                $filters['mileage'] ?? false,
                fn($query, $value) => $query->where('mileage', '<=', $value)
            )
            ->when(
                $filters['location'] ?? false,
                fn($query, $value) => $query->where('location', $value)
            )->when(
                $filters['deleted'] ?? false,
                fn($query, $value) => $query->withTrashed()
            )->when(
                $filters['by'] ?? false,
                fn($query, $value) =>
                !in_array($value, $this->sortable) ? $query :
                $query->orderBy($value, $filters['order'] ?? 'desc')
            );
    }
}
