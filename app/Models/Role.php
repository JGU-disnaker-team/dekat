<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Model;

class Role extends SpatieRole
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];
}
