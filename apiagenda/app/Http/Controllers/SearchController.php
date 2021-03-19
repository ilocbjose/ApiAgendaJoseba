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
    //logica funcion busqueda por name, phone e email aproximandose a lo que se ha escrito

	public function search(Request $request){

		$data = $request->getContent();

        $user = JWTAuth::parseToken()->authenticate();
        $id = $user->id;
        
        $search = $request->data;
        $word = '%'.$search.'%';
        if($data){

            $contact = Contact::where('user_id', $id)
                                ->where('contact_name', 'like', $word)
                                ->orWhere('contact_mail', 'like', $word)
                                ->orWhere('contact_phone', 'like', $word)->get();

            if ($contact->isEmpty()){
                return response()->json('No se ha encontrado ningún contacto', 404);
            }

            return response($contact);
        }

	}
}
