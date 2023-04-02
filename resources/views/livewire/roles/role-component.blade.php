<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    {{-- <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                            <i class="fas fa-plus"></i>
                            Agregar</a>
                    </li> --}}
                </ul>
            </div>
            @include('common.searchBox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white">DESCRIPCIÓN</th>
                                <th class="table-th text-white">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile" wire:click='edit({{$role->id}})' title="Editar Rol">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No hay datos registrados</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.roles.form')
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show')
            });
            window.livewire.on('role-error', msg => {
                noty(msg);
            });
            window.livewire.on('role-added', msg => {
                $('#theModal').modal('hide')
                swal({
                    title: 'Rol ' + msg + ' agregado',
                    text: '',
                    icon: 'success',
                })
            });
            window.livewire.on('role-update', msg => {
                noty(`Rol ${msg}, actualizado`)
                $('#theModal').modal('hide')
            });
        });
    </script>
@endpush



