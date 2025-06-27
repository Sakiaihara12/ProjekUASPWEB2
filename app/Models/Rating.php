<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'menu_id',
        'order_id',
        'rating',
        'comment',
    ];

    // ✅ Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // ✅ Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
