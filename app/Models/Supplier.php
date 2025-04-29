<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Supplier extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, Auditable;

    // use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'country',
        'contact_info',
        'is_active',
    ];

    protected $casts = [
        'id' => 'string',
        'contact_info' => 'array',
        // 'contact_info' => 'json',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->id = (string) Str::uuid());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


}

