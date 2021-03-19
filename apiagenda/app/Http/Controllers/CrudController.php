<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function createContact(Request $request)
    {

		$data = $request->getContent();

		$data = json_decode($data);

		$userToken = JWTAuth::parseToken()->authenticate();

		if($data){

			$validator = Validator::make($request->all(), [

            	'contact_name' => 'required|string|max:255',
            	'contact_phone' => 'required|integer',
            	'contact_email' => 'required|string|email|max:255'
            	
        	]);

        	if($validator->fails()){

                return response()->json($validator->errors()->toJson(), 400);

        	}

			$contact = new Contact();

			$contact->user_id = $userToken->id;

			$contact->contact_name = $request->contact_name;

			$contact->contact_phone = $request->contact_phone;

			$contact->contact_email = $request->contact_email;

			try{

				$contact->save();

			}catch(\Exception $e){

				return response()->json([
                            'status'=>'error',
                            'message'=>'error trying to save'
                        ],500);

			}

            return response()->json([
                'status'=> 'success',
                'message'=>'Contact created'
            ],200);
		}
    }

    public function eraseContact(Request $request)
    {
		$data = $request->getContent();

		if($data){

			$erase_id = $request->id;

			$contact = Contact::where('id', $erase_id)->first();

			$contact->delete();
			
            return response()->json([
                'status'=> 'success',
                'message'=>'User erased'
            ],200);
		}	
    }

    public function updateContact(Request $request, $id)
    {
    	$contact = Contact::find($id);

    	if($contact){

    		$data = $request->getContent();

    		if($data){

    			if(isset($data->contact_name))
					$contact->contact_name = $data->contact_name;

				if(isset($data->contact_phone))
					$contact->contact_phone = $data->contact_phone;

				if(isset($data->contact_email))
					$contact->contact_email = $data->contact_email;

				try{

					$contact->save();

					return response()->json([
                            'status'=> 'success',
                            'message'=>'User updated'
                            ],200);

				}catch(\Exception $e){

					return response()->json([
                            'status'=> 'error',
                            'message'=>'Error trying to update contact'
                            ],500);

				}

    		}else{

                    return response()->json([
                            'status'=> 'error',
                            'message'=>'Error, not data available'
                            ],500);

    		}
    	}else{

    		return response()->json([
                            'status'=> 'error',
                            'message'=>'Error, not data available'
                            ],500);
    	}
    }
    
    public function showContact(Request $request)
    {

    	$user = JWTAuth::parseToken()->authenticate();

    	$userId = $user->id;

    	$contacts = Contact::where('user_id',$userId)->get()->toArray();

		return response()->json($contacts);

    }
}

