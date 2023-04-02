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
        $this->tableTitle = 'Informe de horas registradas y pagadas';
        if (auth()->user()->hasRole('Empleado')) {
            $this->userId = auth()->id();
        }else{
            $this->userId=0;
        }
        $this->reportType = 0;
    }

    public function render()
    {

        $users = User::role('Empleado')->get(['id', 'name']);

        $data = RegistroHora::Reportes($this->reportType, $this->userId)->paginate($this->pagination);

        return view('livewire.reportes.reporte-component', compact('data', 'users'))
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
