<?php

namespace App\Models;

// Relationships
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InventoryLocation extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'inventory_location_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
