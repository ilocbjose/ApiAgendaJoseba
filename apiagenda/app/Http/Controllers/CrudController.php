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
    	Log::info('La funcion de crearContacto ha comenzado');

    	$response = "";

		$data = $request->getContent();

		$data = json_decode($data);

		$userToken = JWTAuth::parseToken()->authenticate();

		if($data){

			Log::info('Los datos se estan validando');

			$validator = Validator::make($request->all(), [

            	'contact_name' => 'required|string|max:255',
            	'contact_phone' => 'required|integer',
            	'contact_email' => 'required|string|email|max:255'
            	
        	]);

        	if($validator->fails()){

        		Log::alert('los datos de validator han fallado');

        		Log::debug(response()->json($validator->errors()->toJson(), 400));

                return response()->json($validator->errors()->toJson(), 400);

        	}

			Log::debug('El usuario ' . $userToken->name . ' esta creando un contacto');

			$contact = new Contact();

			$contact->user_id = $userToken->id;

			$contact->contact_name = $data->contact_name;

			$contact->contact_phone = $data->contact_phone;

			$contact->contact_email = $data->contact_email;

			try{

				$contact->save();

				$response = 'el conctacto se ha creado correctamente';

			}catch(\Exception $e){

				$response = $e->getMessage();

			}

		}

		Log::info('Se ha creado el siguiente contacto');

		Log::debug($contact);

		Log::info('La funcion ha finalizado');

		return response($response);
    }

    public function eraseContact(Request $request)
    {
    	Log::info('La funcion de eraseContact ha comenzado');

    	$response = "";

		$data = $request->getContent();

		$data = json_decode($data);

		if($data){

			$erase_id = $data->id;

			if($erase_id){

				$contact = Contact::where('id', $erase_id)->first();

				$contact->delete();

				$response = 'el contacto ha sido borrado';
			}


		}

		return response($response);
    }

    public function updateContact(Request $request, $id)
    {
    	$contact = Contact::find($id);

    	if($contact){

    		$data = $request->getContent();

    		$data = json_decode($data);

    		if($data){

    			if(isset($data->contact_name))
					$contact->contact_name = $data->contact_name;

				if(isset($data->contact_phone))
					$contact->contact_phone = $data->contact_phone;

				if(isset($data->contact_email))
					$contact->contact_email = $data->contact_email;

				try{

					$contact->save();

					$response = 'El contacto ha sido actualizado';

				}catch(\Exception $e){

					$response = $e->getMessage();

				}

    		}else{

    		$response = 'Los datos introducidos no son correctos';

    		}

    	}else{

    		$response = 'El contacto no existe';
    	}

    	return response($response);
    }
    
}

