<?php

namespace App\Exports;

use App\Models\RegistroHora;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReporteExport implements  FromView, ShouldAutoSize, WithTitle
{
    protected $userId, $reportType;

    public function __construct($userId, $reportType) {
        $this->userId = $userId;
        $this->reportType =$reportType;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $fechaActual = Carbon::now();
        $busqueda = $this->reportType ==2 ? 1: 2;
        $user = User::findOrFail($this->userId)->name;

        $data= RegistroHora::with(['user'=>function($query){
            return $query->role('Empleado')->select('id','name');
        }])
        ->select( 'user_id','cantidad_horas','estado_horas' ,DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as dia'))
        ->whereMonth('fecha',$fechaActual )
        ->where('estado_horas',$busqueda )
        ->where('user_id',$this->userId )
        ->get();
        return view('reports.horas_reportPro', ['data'=>$data, 'reportType'=>$this->reportType, 'user'=>$user]);
    }

     public function title(): string
     {
        return 'Reporte por mes';
     }
}
