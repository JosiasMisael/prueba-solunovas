<?php

namespace App\Http\Livewire;

use App\Models\RegistroHora;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\ComponentConcerns\ValidatesInput;
use Livewire\WithPagination;

class ReporteComponent extends Component
{

    use WithPagination;


    public $userId, $reportType, $pageTitle, $tableTitle;
    private $pagination = 10;
    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->pageTitle = 'Filtros';
        $this->tableTitle = 'Informe de horas de empleados';
        $this->reportType = 0;
    }

    public function render()
    {

        $users = User::role('Empleado')->get(['id', 'name']);
        $data = RegistroHora::with(['user' => function ($query) {
            return $query->role('Empleado');
        }])->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
            ->where('estado_horas', '=', 2)
            ->groupBy('user_id', 'mes')
            ->orderBy('mes', 'asc')
            ->paginate($this->pagination);

        if (($this->reportType == 0 ||$this->reportType == 1) && $this->userId == 0) {
            $data = RegistroHora::with(['user' => function ($query) {
                return $query->role('Empleado');
            }])
                ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                ->where('estado_horas', '=', 2)
                ->groupBy('user_id', 'mes')
                ->orderBy('mes', 'asc')
                ->paginate($this->pagination);
        }
        if ($this->reportType == 2 && $this->userId == 0) {
            $data = RegistroHora::with(['user' => function ($query) {
                return $query->role('Empleado');
            }])
                ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                ->where('estado_horas', '=', 1)
                ->groupBy('user_id', 'mes')
                ->orderBy('mes', 'asc')
                ->paginate($this->pagination);
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
                    ->paginate($this->pagination);
            } else if ($this->reportType == 2) {
                $data = RegistroHora::with(['user' => function ($query) {
                    return $query->role('Empleado');
                }])
                    ->select('user_id', DB::raw('monthName(fecha) AS mes'), DB::raw('SUM(cantidad_horas) AS horas'))
                    ->where('estado_horas', '=', 1)
                    ->where('user_id', $this->userId)
                    ->groupBy('user_id', 'mes')
                    ->orderBy('mes', 'asc')
                    ->paginate($this->pagination);
            }
        }
        return view('livewire.reportes.reporte-component', compact('data', 'users'))
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
