<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class CoaController extends Controller
{
    public function index(){
        return view('admin.masterdata.coa.index');
    }
    public function list(){
        return  Datatables::of(DB::connection('masterdata')->select('Call sp_list_coa()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', ['/admin/masterdata/coa'])){
                $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/masterdata/coa'])){
                $action .= " <a href='/admin/masterdata/coa/delete/$model->id' class='btn btn-sm btn-danger' id='deletecoa'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })->addColumn('parent', function($model){
            if($model->id_parent == 0){
                $parent = 'Main Parent';
            }else{
                $coa = Coa::where(['id' => $model->id_parent])->first();
                $parent =  $coa->coa.'-'.$coa->description;
            }
            return $parent;

        })->make(true);
    }

    public function addmodal(){

        return view('admin.masterdata.coa.addmodal', ['coa' =>DB::connection('masterdata')->select('Call sp_list_coa()') ]);
    }


    public function store(Request $request){

        DB::connection('masterdata')->select("call sp_insert_coa(
            $request->id_parent,
            '$request->coa',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah COA ". $request->coa
        ]);

        NotifEvent::dispatch(auth()->user()->name .' menambahkan COA '. $request->coa);
        return response()->json(['success'=> 'Coa Ditambahkan']);
    }

    public function editmodal(Request $request){

        return view('admin.masterdata.coa.editmodal', ['coa' => Coa::where(['id' => $request->id])->first(), 'parentcoa' => Coa::all()]);
    }

    public function update(Request $request){

        DB::connection('masterdata')->select("call sp_update_coa(
            $request->id,
            '$request->coa',
            '$request->description',
            $request->status
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah COA ". $request->coa
        ]);

        NotifEvent::dispatch(auth()->user()->name .' mengedit Coa '. $request->coa);
        return response()->json(['success'=> 'Coa diubah menjadi '. $request->coa]);
    }

    public function destroy(Request $request){
       $coa = Coa::where(['id' => $request->id])->first();
       UserActivity::create([
           'id_user' => auth()->user()->id,
           'menu' => "COA",
           'aktivitas' => "Hapus",
           'keterangan' => "Hapus COA ". $coa->coa
        ]);

        DB::connection('masterdata')->select("call sp_delete_coa(
            $request->id
        )");

        NotifEvent::dispatch(auth()->user()->name .' menghapus Coa '. $coa->coa);
        return response()->json(['success'=> 'Coa Dihapus']);

    }
}