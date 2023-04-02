<?php

namespace App\Http\Livewire;

use App\Http\Requests\CatalogoRequest;
use App\Models\CatalogoHora;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogoHorasComponent extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    public $tarea, $horas_estimadas, $descripcion, $search = '', $selected_id, $pageTitle, $componentName;
    private $pagination = 10;
    protected $listeners = ['delete'];

    protected function rules(){
        return (new CatalogoRequest())->rules();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Catálogos';
    }

    public function updatingsearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        if (strlen($this->search) > 0) {
            $catalogos = CatalogoHora::where('tarea', 'like', '%' . $this->search . '%')
                ->where('estado', 1)
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        } else {
            $catalogos = CatalogoHora::where('estado', 1)
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        }
        return view('livewire.catalogoHoras.catalogo-horas-component', compact('catalogos') )
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function edit(CatalogoHora $catalogo)
    {
        $this->selected_id = $catalogo->id;
        $this->tarea = $catalogo->tarea;
        $this->horas_estimadas = $catalogo->horas_estimadas;
        $this->descripcion = $catalogo->descripcion;

        $this->emit('show-modal', 'show-modal!');
    }

    public function store()
    {
        $this->validate();

        $catalogo = CatalogoHora::create([
            'tarea' => $this->tarea,
            'horas_estimadas' => $this->horas_estimadas,
            'descripcion' => $this->descripcion
        ]);
        $this->reserUI();
        $this->emit('catalogo-added', $catalogo->tarea);
    }

    public function update()
    {

        $this->validate();
        $catalogo = CatalogoHora::findOrFail($this->selected_id);
        $catalogo->Update([
            'tarea' => $this->tarea,
            'horas_estimadas' => $this->horas_estimadas,
            'descripcion' => $this->descripcion
        ]);
        $this->reserUI();
        $this->emit('catalogo-update', 'Catalogo Actualizado');
    }


    public function delete(CatalogoHora $catalogo)
    {
        $catalogo->estado = false;
        $catalogo->save();
    }

    public function reserUI()
    {
        $this->tarea = '';
        $this->horas_estimadas ='';
        $this->descripcion ='';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetErrorBag();
    }


}
