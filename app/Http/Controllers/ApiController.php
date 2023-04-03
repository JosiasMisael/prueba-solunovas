<?php

namespace App\Http\Controllers;

use App\Models\CatalogoHora;
use App\Models\RegistroHora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function horasPorEmpleado(){
        $fechaActual = Carbon::now();
        $data= RegistroHora::with(['catalogo','user'=>function($query){
            return $query->role('Empleado')->select('id','name');
        }])
        ->select( 'user_id','cantidad_horas','estado_horas' ,DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
        ->whereMonth('fecha',$fechaActual )
        ->paginate(10);
        return response()->json(['data'=>$data]);
    }

    public function totalHorasEmpleado(){
         $data= RegistroHora::with(['user'=>function($query){
            return $query->role('Empleado');
        }])
        ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
        ->where('estado_horas', '=', 2)
        ->where('user_id', 2)
        ->groupBy('user_id', 'mes')
        ->paginate(10);

        return response()->json(['data'=>$data]);
    }

    public function HorasRango(Request $request){
        $fechaInicio = $request->inicio;
        $fechaFin = $request->fin;

        $data= RegistroHora::with(['catalogo','user'=>function($query){
            return $query->role('Empleado')->select('id','name');
        }])
        ->select( 'user_id','cantidad_horas','estado_horas' ,DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->where('estado_horas',2)
        ->paginate(10);
        return response()->json(['data'=>$data]);
    }
    public function tareasUsuarios(Request $request){

        $data= CatalogoHora::with(['registros','registros.user'])->get();

        return response()->json(['data'=>$data]);
    }
}
