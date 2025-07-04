<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'admin_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Relasi ke Admin (yang membuat menu)
    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

    // ✅ Relasi ke Rating (satu menu bisa punya banyak rating)
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
