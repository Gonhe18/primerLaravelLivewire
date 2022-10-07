<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apellido extends Model
{
    use HasFactory;

    protected $fillable = [
        'apellido',
        'user_id'
    ];

    public function r_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}