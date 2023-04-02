<?php

namespace App\Http\Livewire;

use App\Models\RegistroHora;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartComponent extends Component
{

    public $mesId;
    public $horas;
    public $users;
    public $fechas;
    public $actual;

    public function mount(){
        $this->mesId =Carbon::now()->format('F');
    }
    public function render()
    {


        $mesActual = Carbon::now()->month;
        $this->actual = Carbon::now()->format('F');
        $data= RegistroHora::Grafica($mesActual)->get();


            foreach ($data as $d) {
                $this->horas[] = $d->cantidad_horas;
                $this->users[] = $d->user->name;
                $this->fechas[] = $d->dia;
            }

        return view('livewire.chart.chart-component')
        ->extends('layouts.theme.app')
        ->section('content');;
    }
}
