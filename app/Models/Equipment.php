<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'refcode'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipment) {
            $equipment->refcode = \Carbon\Carbon::now()->format('Ym') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });
    }

}
