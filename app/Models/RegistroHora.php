<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroHora extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'catalogo_hora_id', 'fecha', 'cantidad_horas', 'estado_horas', 'estado'];
    protected $dates = ['fecha'];
    public function catalogo()
    {
        return $this->belongsTo(CatalogoHora::class, 'catalogo_hora_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePermitido($query)
    {
        if (auth()->user()->hasRole('Supervisor')) {
            return $query->with(['catalogo', 'user'])
                ->where('estado', true)
                ->orderBy('id', 'desc');
        }
        return $query->with(['catalogo', 'user'])
            ->where('estado', true)
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc');
    }

    public function scopeGrafica($query, $mesActual)
    {
        if (auth()->user()->hasRole('Supervisor')) {

            return $query->with(['user' => function ($query) {
                    return $query->role('Empleado')->select('id', 'name');
                }])
                    ->select('user_id', 'cantidad_horas', DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
                    ->whereMonth('fecha', $mesActual)
                    ->where('estado_horas', 2);
            }


        return $query->with(['user' => function ($query) {
            return $query->role('Empleado')->select('id', 'name');
        }])
            ->select('user_id', 'cantidad_horas', DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
            ->where('user_id', auth()->id())
            ->whereMonth('fecha', $mesActual)
            ->where('estado_horas', 2);
    }
}

