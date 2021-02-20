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

			switch ($data) {
				case ($contact_name = $data->contact_name):
					# code...
					$contact = Contact::where('contact_name',$contact_name);
					return response($contact,200);
					break;

				case ($contact_phone = $data->contact_phone):
					# code...
					$contact = Contact::where('contact_phone',$contact_phone);
					return response($contact,200);
					break;

				case ($contact_email = $data->contact_email):
					# code...
					$contact = Contact::where('contact_name',$contact_phone);
					return response($contact,200);
					break;
				
				default:
					# code...
					return response('Lo sentimos los datos no corresponden a ningún contacto.');
					break;
			}

		} else {

			return response('Datos introducidos nulos.');

		}

	}

}
