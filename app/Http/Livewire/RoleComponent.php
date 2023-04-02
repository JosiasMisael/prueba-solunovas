<?php

namespace App\Http\Livewire;

use App\Http\Requests\RolRequest;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nombre, $search = '', $selected_id, $pageTitle, $componentName;
    private $pagination = 10;
    protected $listeners = ['delete'];

    protected function rules(){
        return (new RolRequest())->rules();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function updatingsearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        if (strlen($this->search) > 0) {
            $roles = Role::where('name', 'like', '%' . $this->search . '%')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        } else {
            $roles = Role::where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        }
        return view('livewire.roles.role-component', compact('roles'))
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function edit(Role $rol)
    {
        $this->selected_id = $rol->id;
        $this->nombre = $rol->name;

        $this->emit('show-modal', 'show-modal!');
    }

    public function store()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->nombre,
        ]);
        $this->reserUI();
        $this->emit('role-added', $role->name);
    }

    public function update()
    {

        $this->validate();
        $role = Role::findOrFail($this->selected_id);
        $role->Update([
            'name' => $this->nombre,
         ]);
        $this->reserUI();
        $this->emit('role-update', $role->name);
    }


    public function delete(Role $rol)
    {
        $permissionCount = $rol->permissions->count();
        if($permissionCount > 0){
           $this->emit('role-error', 'No se puede eliminar el rol, tiene permisos asociados');
           return;
        }else{
        $rol->status = false;
        $rol->save();
        }
    }

    public function reserUI()
    {
        $this->nombre = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetErrorBag();
    }
}
