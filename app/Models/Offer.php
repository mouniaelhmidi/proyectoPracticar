<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'name',
        'description',
        'categories',
    ];

    //relacion uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}