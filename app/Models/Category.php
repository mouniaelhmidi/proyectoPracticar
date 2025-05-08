<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class Category extends Model
{
    //use HasFactory;

    protected $fillable = [
        'name',
    ];

    //relacion uno a muchos
    public function offers()
    {
        return $this->hasMany(Offer::class, 'category_id');
    }

}
