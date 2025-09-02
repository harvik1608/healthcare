<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'professional_id',
        'date',
        'stime',
        'etime',
        'note',
        'status'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id', 'id');
    }
}
