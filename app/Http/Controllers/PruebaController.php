<?php

namespace App\Http\Controllers;

use App\Models\RegistroHora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    public function prueba(){

       /* $data= RegistroHora::with(['user'=>function($query){
            return $query->role('Empleado');
        }])
        ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
        ->where('estado_horas', '=', 2)
        ->where('user_id', 2)
        ->groupBy('user_id', 'mes')
        ->paginate(4);*/
        $fechaActual = Carbon::now();
        $data= RegistroHora::with(['user'=>function($query){
            return $query->role('Empleado')->select('id','name');
        }])
        ->select( 'user_id','cantidad_horas','estado_horas' ,DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
        ->whereMonth('fecha',$fechaActual )
        ->get();

         return $data;
    }
}
