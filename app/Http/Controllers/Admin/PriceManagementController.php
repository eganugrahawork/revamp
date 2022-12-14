<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\PriceHistory;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class PriceManagementController extends Controller
{
    public function index(){

        return view('admin.pricemanagement.index', ['items' => Items::all()]);
    }

    public function editmodal(Request $request){

        return view('admin.pricemanagement.editmodal',['item' => Items::where(['id' => $request->id])->first()]);
    }

    public function update(Request $request){
        PriceHistory::where(['id' =>$request->id])->update([
            'top_price' => $request->top_price,
            'bottom_price' => $request->bottom_price,
            'harga_good_sold' => $request->harga_good_sold
        ]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Price Management",
            'aktivitas' => "Price Edit",
            'keterangan' => "Price Edit Price Management ". $request->id
         ]);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }
}
