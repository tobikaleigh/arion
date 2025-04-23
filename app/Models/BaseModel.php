<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Traits
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class BaseModel extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public final function uniqueIds()
    {
        return ['uuid'];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
