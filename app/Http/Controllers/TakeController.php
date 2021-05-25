<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TakeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $takes = Take::all();
        return view('take', compact('takes', 'products'));

    }
    public function submit_take(Request $reque){
        $take = new Take;
        $take->id_product = $reque->get('id_product');
        $take->qty =$reque->get('qty');

        $take->save();

        $notification = array(
            'message' => 'Data Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('take')->with($notification);
    }

    public function store(Request $reque)
    {
        $take = new Take;

        $products = Product::findOrFail($reque->id);
        $take->id_product = $reque->get('id_product');
        $take->qty =$products->qty -= $reque->get('qty');
        $take->save();

        $notification = array(
            'message' => 'Data Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('take')->with($notification);
    }

    public function getDataTake($id)
    {
        $take = Take::find($id);

        return response()->json($take);
    }
}
