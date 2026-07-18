<?php

namespace Zerp\ExamplePackage\Models;

use App\Models\Concerns\TenantScoped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamplePackageItem extends Model
{
    use HasFactory, TenantScoped;

    protected $table = 'examplepackage_items';

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'creator_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}