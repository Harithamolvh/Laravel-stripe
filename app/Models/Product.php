<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getPriceInCents()
    {
        return $this->price * 100;
    }

    public function getFormattedPrice()
    {
        return '$' . number_format($this->price, 2);
    }
}
