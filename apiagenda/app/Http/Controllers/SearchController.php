<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //logica funcion busqueda por name, phone e email

	public function search(Request $request){

		$response = '';

		$data = $request->getContent();

		$data = json_decode($data);

		if($data){

			if($data->contact_name){
				$contact_name = $data->contact_name;
				$contact = Contact::where('contact_name',$contact_name);
					return response($contact,200);

			}elseif($data->contact_phone){
				$contact_phone = $data->contact_phone;
				$contact = Contact::where('contact_name',$contact_name);
					return response($contact,200);

			}elseif($data->contact_email){
				$contact_email = $data->contact_email;
				$contact = Contact::where('contact_name',$contact_phone);
					return response($contact,200);
			}else{

				return response('No existe ningún usuario.');

			}

		} else {

			return response('Datos introducidos nulos.');

		}

	}

	public function index(Request $request){

		$response = "";
		$data = $request->getContent();

		$data = json_decode($data);

		if($data){

			$user = JWTAuth::parseToken()->authenticate();

			if($user){

				$id_user = $user->id;

				$contacts = Contacts::where('id',$id_user)->get();

				return response($contacts);

			}else{

				return response('Datos del usuario erroneos.');

			}

		}else{

			return response('No existen usuarios asociados ese ID.');

		}

	}

}
