<?php

namespace App\Http\Controllers\Admin\Accounting;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function index(){
        return view('admin.accounting.neraca.index');
    }
}