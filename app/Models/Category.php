<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function furniture()
    {
        return $this->hasMany(Furniture::class);
    }
    
    // Hitung jumlah produk di kategori ini
    public function getFurnitureCountAttribute()
    {
        return $this->furniture()->count();
    }
}