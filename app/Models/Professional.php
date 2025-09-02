<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professional extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'speciality_id',
        'is_active',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }
}
