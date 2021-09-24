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
    
       $rules =array(
            'name' => 'required',
            'phone_number' => 'required|unique:users',
            'handset_type' => 'required' 
        );
        $validator=Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            return $validator->errors();
        }


        $name = $request->input('name');
        $phone_number = $request->input('phone_number');
        $handset_type = $request->input('handset_type');
        $handset_type_id=Handset::where('handset_type' , $handset_type)->select('id')->first();
       
//echo $handset_type_id['id'];
        if(!($handset_type_id))
        {
            return response()->json(['error' => 'please enter values from Mobile phone,Desk phone or Software phone'],400);
   
             
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
       $record=$user->delete();
       if($record){
       return response()->JSON(['message'=> "user deleted successfully"] , 200);
       }
       else{
        return response()->JSON(['error'=> "user does not exist"] , 400);

       }
    }
}
