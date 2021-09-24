<?php

namespace App\Http\Controllers;

use App\Models\Handset;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

        $users = DB::table('users')
            ->leftJoin('handsets', 'users.handset_type_id', '=', 'handsets.id')
            ->select('users.name', 'users.phone_number', 'handsets.handset_type')->get();
        return response()->JSON(['data' => $users], 200);
    }
    public function create(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required|unique:users',
            'handset_type' => 'required' 
        ]);
        if ($validator->fails()) {
            return response()->JSON($validator->errors()->first(), '');
        }


        $name = $request->input('name');
        $phone_number = $request->input('phone_number');
        $handset_type = $request->input('handset_type');
        $handset_type_id=Handset::where('handset_type' , $handset_type)->select('id')->first();
       
//echo $handset_type_id['id'];
        if(!($handset_type_id))
        {
            return response()->json(['error' => 'please enter Mobile phone,Desk phone or Software phone' , 'code' => 400 ],400);
   
             
        }
        
            $user=User::create(array(
                'name' => $name,
                'phone_number' => $phone_number,
                'handset_type_id' => $handset_type_id['id']
                
            ));
            if ($user) {
                return response()->JSON(['data' => $user], 200);
                
            } else {
                return response()->json(['error' => 'phone number already exist' , 'code' => 400 ],400);
   
            }
        
    }
       
    

    public function delete($id)
    {
       $user=User::findorFail($id);
       $user->delete();
       return response()->JSON(['data'=>$user] , 200);

    }
}
