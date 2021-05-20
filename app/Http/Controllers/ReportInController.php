<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Report;
use PDF;
use Illuminate\Http\Request;

class ReportInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $reports = report::all();
        return view('admin.reportin', compact('reports'));
    }

    public function print_reportin()
    {
        $reports = report::all();
        $pdf = PDF::loadview('admin.print_reportin', ['reports' => $reports]);
        return $pdf->download('Laporan_Barang_Masuk.pdf');
    }
}
