<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $arr = array();
        //$list= User::all();
        $users = User::with('handsets')->get();
        foreach ($users as $user) {
            $data['name'] = $user->name;
            $data['phone_number'] = $user->phone_number;
            // $data['handset_type'] = $user->handsets->handset_type;
            foreach ($user->handsets as $handset) {
                $data['handset_type'] = $handset->handset_type;
                
            }
          
        }
        return response()->JSON(['data' => $data], 200);
      
    }
}
