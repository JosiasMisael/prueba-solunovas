<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }}</b> | {{ $pageTitle }}
                </h4>
                   @role('Supervisor')
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                            <i class="fas fa-plus"></i>
                            Agregar</a>
                    </li>
                </ul>
                @endrole
            </div>
            @include('common.searchBox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white text-center">Nombre</th>
                                <th class="table-th text-white text-center">Correo</th>
                                <th class="table-th text-white text-center">Rol</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $user->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $user->email }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <h6>{{ $user->roles->first()->name }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile"
                                            wire:click="edit({{ $user->id }})" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @role('Supervisor')
                                        <a href="javascript:void(0)"
                                            wire:click="$emit('deleteuser', {{ $user->id }}, '{{ $user->name }}')"
                                            class="btn btn-dark " title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endrole
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No hay datos registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
    @include('livewire.user.form')
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            livewire.on('deleteuser', (id, name) => {
                swal({
                        title: 'Estas seguro de eliminar el usuario ' + name + '?',
                        text: '',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.livewire.emit('delete', id)
                            swal("usuario " + name + " se ha eliminado", {
                                icon: "success",
                            });
                        }
                    });
            });

            window.livewire.on('added-user', msg => {
                $('#theModal').modal('hide')
                swal({
                    title: 'usuario ' + msg + ' agregado',
                    text: '',
                    icon: 'success',
                })
            });

            window.livewire.on('updated-user', msg => {
                $('#theModal').modal('hide')
                swal({
                    title: 'usuario ' + msg + ' actualizado',
                    text: '',
                    icon: 'success',
                })
            });


            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show')
            });


        });
    </script>

@endpush
