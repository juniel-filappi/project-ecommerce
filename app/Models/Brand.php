<?php

namespace App\Models;

use App\Observers\BrandObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(BrandObserver::class)]
class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_featured',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
