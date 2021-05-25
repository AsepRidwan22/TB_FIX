<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Reportout;
use PDF;

class ReportOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $reportouts = reportout::all();
        return view('admin.reportout', compact('reportouts'));
    }

    public function print_reportout()
    {
        $reportouts = reportout::all();
        $pdf = PDF::loadview('admin.print_reportout', ['reportouts' => $reportouts]);
        return $pdf->download('Laporan_Barang_Keluar.pdf');
    }
}
