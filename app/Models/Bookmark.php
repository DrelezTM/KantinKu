<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'product_id', 'created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
