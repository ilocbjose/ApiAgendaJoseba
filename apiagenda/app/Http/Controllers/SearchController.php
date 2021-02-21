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

		$data = $request->getContent();

		$data = json_decode($data);

		if($data){

			$contact = Contact::find($request->request)->get()->toArray();

			if($contact){

					return reponse($contact);

			}else{

				return 'No existe ningún usuario.';

			}

		} else {

			return 'Datos introducidos nulos.';

		}

	}
}
