<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }}</b> | {{ $pageTitle }}
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                            <i class="fas fa-plus"></i>
                            Agregar</a>
                    </li>
                </ul>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white text-center">Usuario</th>
                                <th class="table-th text-white text-center">Tarea</th>
                                <th class="table-th text-white text-center">Horas Estimadas</th>
                                <th class="table-th text-white text-center">Horas Registradas</th>
                                <th class="table-th text-white text-center">Fecha</th>
                                <th class="table-th text-white text-center">Estado</th>
                                <th class="table-th text-white text-center">ACTIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registros as $registro)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $registro->user->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $registro->catalogo->tarea }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $registro->catalogo->horas_estimadas }} Horas</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $registro->cantidad_horas }} Horas</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $registro->fecha->locale('es')->translatedFormat('d M Y') }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $registro->estado_horas ===1 ? 'badge-success' : 'badge-info' }} text-uppercase">
                                            {{ $registro->estado_horas==1 ? 'Registrado' : 'Pagado' }}
                                        </span>                                    </td>

                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" wire:click="edit({{$registro->id}})" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                        wire:click="$emit('deleteRegistro', {{ $registro->id }})"
                                        class="btn btn-dark " title="Delete">
                                            <i class="fas fa-trash"></i>
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
                    {{ $registros->links() }}

                </div>
            </div>
        </div>
    </div>
    @include('livewire.registroHoras.form')
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            livewire.on('deleteRegistro', (id, name) => {
                swal({
                        title: 'Estas Seguro de eliminar ' + name + ' ?',
                        text: '',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.livewire.emit('delete', id)
                            swal("registroo " + name + " se ha eliminado", {
                                icon: "success",
                            });
                        }
                    });
            });

            window.livewire.on('added-registro', msg => {
                $('#theModal').modal('hide')
                swal({
                    title: 'registroo ' + msg + ' agregado',
                    text: '',
                    icon: 'success',
                })
            });

            window.livewire.on('updated-registro', msg => {
                $('#theModal').modal('hide')
                swal({
                    title: 'registroo ' + msg + ' actualizado',
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
