<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$pageTitle}}</b>
                </h4>
            </div>
            <div class="widget-content">
               <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Elige un usuario</h6>
                            <div class="form-group">
                                <select wire:model="userId" class="form-control ">
                                    <option value="0">Todos</option>
                                    @foreach ($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6>Tipo de reporte</h6>
                            <div class="form-group">
                                <select wire:model="reportType" class="form-control">
                                    <option value="0" disabled selected>Seleccione</option>
                                    <option value="1">Horas Pagadas</option>
                                    <option value="2">Horas Registradas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <a href="{{ url('report/excel'.'/'.$userId . '/' . $reportType) }}" class="btn btn-dark btn-block {{ count($users) < 1 ? 'disabled' : ''}}" target="_blank">Exportar a Excel</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="widget-heading">
                        <h4 class="card-title text-center">
                            <b>{{$tableTitle}}</b>
                        </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th width="400px" class="table-th text-white text-center">EMPLEADO</th>
                                    <th width="400px" class="table-th text-white text-center">MES</th>
                                    <th width="400px" class="table-th text-white text-center">{{$reportType ==2 ? 'HORAS REGISTRADAS PENDIENTES DE PAGO':'HORAS TRABAJADAS Y PAGADAS' }}  </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $dat)
                                <tr>
                                    <td >{{ $dat->user->name }} </td>
                                    <td class="text-center">{{ $dat->mes }} </td>
                                    <td class="text-center">{{ $dat->horas }} </td>
                                </tr>
                                    @endforeach

                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function(){

  });
</script>



