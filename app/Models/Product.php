<?php

namespace App\Models;

// Relationships
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends BaseModel
{
    /**
     * The inventory locations that belong to the product.
     */
    public function inventoryLocations(): BelongsToMany
    {
        return $this->belongsToMany(InventoryLocation::class, 'inventory_location_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
