<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoHora extends Model
{
    use HasFactory;
    protected $fillable =['tarea','horas_estimadas', 'descripcion','disponibilidad','estado'];

    public function registros(){
        return $this->hasMany(RegistroHora::class);
    }

}
