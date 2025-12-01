<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'product_id',
        'ip_address',
        'created_at'
    ];

    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
