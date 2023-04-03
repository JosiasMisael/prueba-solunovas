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
            $roles = Role::where('display_name', 'like', '%' . $this->search . '%')
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
        $this->nombre = $rol->display_name;

        $this->emit('show-modal', 'show-modal!');
    }

    public function store()
    {
        $this->validate();

        $role = Role::create([
            'display_name' => $this->nombre,
        ]);
        $this->reserUI();
        $this->emit('role-added', $role->display_name);
    }

    public function update()
    {

        $this->validate();
        $role = Role::findOrFail($this->selected_id);
        $role->Update([
            'display_name' => $this->nombre,
         ]);
        $this->reserUI();
        $this->emit('role-update', $role->display_name);
    }



    public function reserUI()
    {
        $this->nombre = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetErrorBag();
    }
}
