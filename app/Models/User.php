<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registros(){
        return $this->hasMany(RegistroHora::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopePermitido($query, $search){
        if(auth()->user()->hasRole('Supervisor')){
            if (strlen($search) > 0){
                return $query->where('name', 'like', '%' . $search . '%')
                ->where('estado', true)
                ->orderBy('id', 'desc');
            }else{
                return $query->where('estado', true)
                ->orderBy('id', 'desc');
            }
        }
        return $query->where('id', auth()->id());
    }
}
