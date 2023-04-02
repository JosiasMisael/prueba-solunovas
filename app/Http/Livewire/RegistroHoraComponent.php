<?php

namespace App\Http\Livewire;

use App\Http\Requests\RegistroHorasRequest;
use App\Models\CatalogoHora;
use App\Models\RegistroHora;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegistroHoraComponent extends Component
{
    use WithPagination, AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $componentName, $pageTitle, $search = '';
    public $cantidad_horas, $selected_id, $catalogo;
    private $pagination = 10;
    public $registro;
    protected $listeners = ['delete','pagar'];

  protected function rules(){

    return (new RegistroHorasRequest())->rules();
  }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingsearch()
    {
        $this->resetPage();
    }

    public function mount(RegistroHora $registro)
    {
        $this->registro = $registro;
        $this->pageTitle = 'Listado';
        $this->componentName = 'Registro Horas';
    }


    public function render()
    {
      //  dd($this->registro->);
       // $this->authorize('view', $this->registro);
        $registros = RegistroHora::Permitido()->paginate($this->pagination);

        $catalogos = CatalogoHora::where('estado',true)->where('disponibilidad', true)->get(['id','tarea','horas_estimadas']);

        return view('livewire.registroHoras.registro-hora-component', compact('catalogos','registros'))
               ->extends('layouts.theme.app')
               ->section('content');
    }

    public function store(){
      $this->validate();
      $time = Carbon::now();

      $registro=RegistroHora::create([
          'user_id'=>auth()->user()->id,
          'catalogo_hora_id'=> $this->catalogo,
          'fecha'=>$time->toDateString() ,
          'cantidad_horas'=>$this->cantidad_horas,
          'estado_horas'=>1,
        ]);

         $catalogoHoras =CatalogoHora::FindOrFail($registro->catalogo_hora_id);
         $catalogoHoras->Update([
            'disponibilidad'=>false
         ]);
        $this->reserUI();
        $this->emit('added-registro', $registro->name);
    }

    public function edit(RegistroHora $registro){
        $this->selected_id = $registro->id;
        $this->cantidad_horas = $registro->cantidad_horas;
        $this->catalogo = $registro->catalogo_hora_id;
        $this->emit('show-modal', 'edit');
    }

    public function update(){
       $this->validate();
       $registro = RegistroHora::findOrFail($this->selected_id);
       $registro->Update([
        'catalogo_hora_id'=> $this->catalogo,
        'cantidad_horas'=>$this->cantidad_horas,
       ]);

       $this->reserUI();
       $this->emit('updated-registro', $registro->name);
    }
    public function delete(RegistroHora $registro)
    {
        $catalogoHoras =CatalogoHora::FindOrFail($registro->catalogo_hora_id);
        $catalogoHoras->Update([
            'disponibilidad'=>true
         ]);
        $registro->estado = false;
        $registro->save();
    }

    public function pagar(RegistroHora $registro)
    {
        $registro->estado_horas = 2;
        $registro->save();
    }


    public function reserUI()
    {
        $this->cantidad_horas = '';
        $this->catalogo='';
        $this->selected_id = 0;
       $this->resetErrorBag();
    }


}
