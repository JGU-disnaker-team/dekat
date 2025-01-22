<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Role extends SpatiePermission
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids;

    protected $primarykey = [
        'uuid',
    ];
}
