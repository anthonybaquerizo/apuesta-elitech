<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\User;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Devuelve el usuario logeado
     */
    public function getAuth(Request $request) 
    {
        return Auth::user();
    }

    /**
     * Actualiza los datos del usuario
     */
    public function saveUser(UserRequest $request) 
    {
        try {
            $objUser = User::find($request->id);
            if (empty($objUser)) {
                throw new Exception('El Usuario no pudo ser encontrado');    
            }
            $objUser->fill([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]);
            if (!empty($request->password)) {
                $objUser->setAttribute('password', bcrypt($request->password));
            }
            $objUser->save();
            $this->response['status'] = 200;
            $this->response['message'] = 'Datos actualizados correctamente';
        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

}
