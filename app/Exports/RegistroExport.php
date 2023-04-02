<?php

namespace App\Exports;

use App\Models\RegistroHora;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class RegistroExport implements  FromView, ShouldAutoSize, WithTitle
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
        $data =[];

            $user = $this->userId > 0 ?  User::findOrFail($this->userId)->name : 'General';
        if ($this->reportType == 0 || $this->reportType == 1 && $this->userId == 0) {
            $data = RegistroHora::with(['user' => function ($query) {
                return $query->role('Empleado');
            }])
                ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                ->where('estado_horas', '=', 2)
                ->groupBy('user_id', 'mes')
                ->orderBy('mes', 'asc')
                ->get();
        }
        if ($this->reportType == 2 && $this->userId == 0) {
            $data = RegistroHora::with(['user' => function ($query) {
                return $query->role('Empleado');
            }])
                ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                ->where('estado_horas', '=', 1)
                ->groupBy('user_id', 'mes')
                ->orderBy('mes', 'asc')
                ->get();
            } else if ($this->userId > 0) {
            if ($this->reportType == 1) {
                $data = RegistroHora::with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 2)
                    ->where('user_id', $this->userId)
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc')
                    ->get();
                } else if ($this->reportType == 2) {
                $data = RegistroHora::with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 1)
                    ->where('user_id', $this->userId)
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc')
                    ->get();
            }
        }
        return view('reports.horas_report', ['data'=>$data, 'reportType'=>$this->reportType, 'user'=>$user]);
    }

     public function title(): string
     {
        return 'Reporte Horas Empleados';
     }
}
