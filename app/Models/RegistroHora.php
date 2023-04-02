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

    public function scopeReportes($query, $reportType, $userId){
        if(auth()->user()->hasRole('Supervisor')){
            if ($reportType == 0 || $reportType == 1 && $userId == 0) {
                return $query->with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 2)
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc');
            }
            if ($reportType == 2 && $userId == 0) {
                return $query->with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 1)
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc');
            } else if ($userId > 0) {

                if ($reportType == 1) {
                    return $query->with(['user' => function ($query) {
                        return $query->role('Empleado');
                    }])
                        ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                        ->where('estado_horas', '=', 2)
                        ->where('user_id', $userId)
                        ->groupBy('user_id', 'mes')
                        ->orderBy('mes', 'asc');
                } else if ($reportType == 2) {
                    return $query->with(['user' => function ($query) {
                        return $query->role('Empleado');
                    }])
                        ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                        ->where('estado_horas', '=', 1)
                        ->where('user_id', $userId)
                        ->groupBy('user_id', 'mes')
                        ->orderBy('mes', 'asc');
                }
            }
        }
        if(auth()->user()->hasRole('Empleado')){
            if ($reportType == 0 || $reportType == 1 ) {
                return $query->with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 2)
                    ->where('user_id', auth()->id())
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc');
            }
            else if ($reportType == 2) {
                return $query->with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 1)
                    ->groupBy('user_id', 'mes')
                    ->where('user_id', auth()->id())
                    ->orderBy('mes', 'asc');
            }
        }


    }
}

