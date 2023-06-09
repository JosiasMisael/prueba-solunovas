<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div>
        <h2>{{$reportType ==2 ? 'REPORTE HORAS REGISTRADAS PENDIENTES DE PAGO':'HORAS TRABAJADAS Y PAGADAS' }} de {{$user}} </h2>
            <table>
                <thead>
                    <tr>
                        <th><strong>EMPLEADO</strong> </th>
                        <th><strong>TAREA</strong> </th>
                        <th><strong>HORAS ESTIMADAS</strong> </th>
                        <th><strong>{{$reportType ==2 ? 'HORAS REGISTRADAS PENDIENTES DE PAGO':'HORAS TRABAJADAS Y PAGADAS' }}</strong></th>
                        <th><strong>FECHA </strong> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dat)
                    <tr>
                        <td class="text-center">{{ $dat->user->name }} </td>
                        <td class="text-center">{{ $dat->catalogo->tarea }} </td>
                        <td class="text-center">{{ $dat->catalogo->horas_estimadas }} </td>
                        <td class="text-center">{{ $dat->cantidad_horas }} </td>
                        <td class="text-center">{{ $dat->dia, }} </td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
    </div>
</body>
</html>
