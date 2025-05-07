<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'categories',
    ];

    //relacion uno a muchos
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
