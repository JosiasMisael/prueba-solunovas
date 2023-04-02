<?php

namespace App\Http\Controllers;

use App\Models\RegistroHora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    public function prueba(){

        $data= RegistroHora::with(['user'=>function($query){
            return $query->role('Empleado');
        }])
        ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
        ->where('estado_horas', '=', 2)
        ->where('user_id', 2)
        ->groupBy('user_id', 'mes')
        ->paginate(4);
         return $data;
    }
}
