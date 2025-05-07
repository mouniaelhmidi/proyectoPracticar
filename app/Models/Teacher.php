<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'suename',
        'email'
    ];


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

}
