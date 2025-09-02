<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    public $timestamps = false;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'parent_code', 'code');
    }

    public function child(): HasMany
    {
        return $this->hasMany(Region::class, 'parent_code', 'code');
    }

    #[Scope]
    public function province($query)
    {
        $query->where('type', 'province');
    }

    #[Scope]
    public function regency($query)
    {
        $query->where('type', 'regency');
    }

    #[Scope]
    public function district($query)
    {
        $query->where('type', 'district');
    }

    #[Scope]
    public function village($query)
    {
        $query->where('type', 'village');
    }
}
