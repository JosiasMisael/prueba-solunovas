<?php

namespace App\Http\Controllers;

use App\Exports\RegistroExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    public function reporteExcel($userId, $reportType){
        return Excel::download( new RegistroExport($userId, $reportType),'Reporte horas_.xlsx' );
    }
}
