<?php

namespace App\Http\Controllers;
use App\Models\Handset;
use App\Models\User;

use Illuminate\Http\Request;

class UserHandsetController extends Controller
{
    public function index()
    {
        $arr=[];
       $users = User::with('handsets')->get();
    //    $user_handsets=$users->pluck('handsets.handset_type');
    foreach($users as $user){
           $data['name']= $user->name;
           $data['phone_number']= $user->phone_number;
           foreach($user->handsets as $handset)
           {
            $data['handset_type']= $handset->handset_type; 
           }
array_push($arr,$data);
    }
    return response()->JSON(['data' => $arr], 200);
    }
}
