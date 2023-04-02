<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $pageTitle }} | {{ $componentName }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                            <i class="fas fa-plus"></i>
                            Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchBox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th width="400px" class="table-th text-white text-center">TAREA</th>
                                <th width="400px" class="table-th text-white text-center">HORAS ESTIMADAS</th>
                                <th width="400px" class="table-th text-white text-center">DESCRIPCION</th>
                                <th width="400px" class="table-th text-white text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($catalogos as $catalogo)
                                <tr>
                                    <td>{{ $catalogo->tarea }} </td>
                                    <td>{{ $catalogo->horas_estimadas }} Horas </td>
                                    <td>{{ $catalogo->descripcion }} </td>

                                    <td class="text-right">
                                        <a href="javascript:void(0)" wire:click='edit({{ $catalogo->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                            wire:click="$emit('deletecatalogo', {{ $catalogo->id }}, '{{ $catalogo->tarea }}')"
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
                    {{ $catalogos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.catalogoHoras.form')
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show')
            });

            window.livewire.on('catalogo-added', msg => {
                $('#theModal').modal('hide')
                swal({
                    title:  msg + ' agregado',
                    text: '',
                    icon: 'success',
                })
            });
            window.livewire.on('catalogo-update', msg => {
                noty(`catalogo actualizado`)
                $('#theModal').modal('hide')
            });


            window.livewire.on('deletecatalogo', (id, name) => {
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
                            swal("Categoria " + name + " se ha eliminado", {
                                icon: "success",
                            });
                        }
                    });
            });


        });
    </script>
@endpush
