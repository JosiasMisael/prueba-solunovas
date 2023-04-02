<?php

namespace App\Http\Livewire;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nombre, $correo,  $role, $estado,  $search = '', $selected_id, $pageTitle, $componentName;
    private $pagination = 5;
    protected $listeners = ['delete'];

    protected function rules(){
        return (new UserRequest())->rules();
    }


    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
    }

    public function updatingsearch()
    {
        $this->resetPage();
    }

    public function render()
    {


        $users = User::Permitido($this->search)->paginate($this->pagination);

        $roles = Role::where('status', 1)->orderBy('name', 'desc')->get();

        return view('livewire.user.user-component', compact('users','roles'))
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function store(){
        $this->validate();
       $contraseña = Str::random(8);
        $user=User::create([
              'name'=>$this->nombre,
              'email'=>$this->correo,
              'password'=>$contraseña,
          ]);
         $user->assignRole($this->role);
          $this->reserUI();
          $this->emit('added-user', $user->name);
      }

      public function edit(User $user){
          $this->selected_id = $user->id;
          $this->nombre = $user->name;
          $this->correo = $user->email;
          $this->role = $user->roles->first()->id;
          $this->estado = $user->estado;
          $this->emit('show-modal', 'edit');
      }

      public function update(){
         $this->validate();
         $user = User::findOrFail($this->selected_id);
        // $contraseña = str_random(8);

         $user->Update([
            'name'=>$this->nombre,
            'email'=>$this->correo,
            'password'=>$contraseña,
            'estado'=>$this->estado,
         ]);

         $this->reserUI();
         $this->emit('updated-user', $user->name);
      }
      public function delete(User $user)
      {
          $user->estado = '0';
          $user->save();
      }

      public function reserUI()
      {
          $this->nombre = '';
          $this->correo='';
          $this->estado='';
          $this->search = '';
          $this->selected_id = 0;
         $this->resetErrorBag();
      }

}
