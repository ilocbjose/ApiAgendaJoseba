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
				$contact = Contact::where('contact_name',$contact_name)->get()->toArray();
					return $contact;

			}elseif($data->contact_phone){
				$contact_phone = $data->contact_phone;
				$contact = Contact::where('contact_phone',$contact_phone)->get()->toArray();
					return $contact;

			}elseif($data->contact_email){
				$contact_email = $data->contact_email;
				$contact = Contact::where('contact_email',$contact_email)->get()->toArray();
					return $contact;
			}else{

				return 'No existe ningún usuario.';

			}

		} else {

			return 'Datos introducidos nulos.';

		}

	}
}
