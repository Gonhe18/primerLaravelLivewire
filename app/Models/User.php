<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getImageUserAttribute()
    {
        return $this->profile_photo_path ?? 'img/default_user.png';
    }

    // Setea los roles para que figuren correctamente para el usuario
    public function getRolAttribute()
    {
        if ($this->role == 'admin') {
            return "Administrador";
        }
        return $this->role == "vendedor" ? "Vendedor" : "Cliente";
    }

    public function r_lastname()
    {
        return $this->hasOne(Apellido::class, 'user_id', 'id');
    }

    // Permite buscar por clave foranea
    public function scopeTermino($query, $termino)
    {
        if ($termino == "") {
            return;
        }
        return $query->where('name', 'like', "%{$termino}%")
            ->orWhere('email', 'like', "%{$termino}%")
            ->orWhereHas('r_lastname', function ($query2) use ($termino) {
                $query2->where('apellido', 'like', "%{$termino}%");
            });
    }

    // Permite filtrar por rol
    public function scopeRole($query, $role)
    {
        if ($role == "") {
            return;
        }
        return $query->whereRole($role);
    }
}