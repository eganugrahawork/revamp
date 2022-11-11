<?php

use Illuminate\Support\Facades\DB;

function checkAccess($data){

    $result = DB::connection('masterdata')->select("select * from menu_access where menu_id = $data[menu_id] AND role_id = $data[role_id]");

    if($result){
        echo "Checked";
    }else{
        echo "x-circle";
    }
}

function checkPermissionMenuApprove($data){
    $result = DB::connection('masterdata')->select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and approve = 1");

    if($result){
        echo"Checked";
    }
}
function checkPermissionMenuCreate($data){
    $result = DB::connection('masterdata')->select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and created = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuEdit($data){
    $result = DB::connection('masterdata')->select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and edit = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuDelete($data){
    $result = DB::connection('masterdata')->select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and deleted = 1");

    if($result){
        echo"Checked";
    }
}



?>
