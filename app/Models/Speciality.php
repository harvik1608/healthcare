<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    public function professionals()
    {
        return $this->hasMany(Professional::class, 'speciality_id', 'id');
    }
}
