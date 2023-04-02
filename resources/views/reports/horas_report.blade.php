<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div>
        <h2>{{$reportType ==2 ? 'REPORTE HORAS REGISTRADAS PENDIENTES DE PAGO':'HORAS TRABAJADAS Y PAGADAS' }} -{{$user}} </h2>
            <table>
                <thead>
                    <tr>
                        <th><strong>EMPLEADO</strong> </th>
                        <th><strong>MES</strong> </th>
                        <th><strong>{{$reportType ==2 ? 'HORAS REGISTRADAS PENDIENTES DE PAGO':'HORAS TRABAJADAS Y PAGADAS' }}</strong></th>
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
    </div>
</body>
</html>
