<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroHora extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','catalogo_hora_id','fecha','cantidad_horas','estado_horas','estado'];
    protected $dates = ['fecha'];
    public function catalogo(){
        return $this->belongsTo(CatalogoHora::class,'catalogo_hora_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopePermitido($query){
        if(auth()->user()->hasRole('Supervisor')){
            return $query->with(['catalogo','user'])
            ->where('estado', true)
            ->orderBy('id', 'desc');
        }
        return $query->with(['catalogo','user'])
        ->where('estado', true)
        ->where('user_id', auth()->id())
        ->orderBy('id', 'desc');
    }
}
