<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $users = DB::table('users')
        ->leftJoin('handsets', 'users.handset_type_id', '=', 'handsets.id')
        ->select('users.name','users.phone_number','handsets.handset_type') -> get();
        return response()->JSON(['data' => $users], 200);
      
    }
}
