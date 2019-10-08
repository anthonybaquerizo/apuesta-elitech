<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Model\UserType;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    /**
     * Inicio de sesión
     */
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            $this->response['status'] = 200;
            $this->response['message'] = "Bienvenido {$username}";
            $this->response['data'] = Auth::user()->getAttributes();
        } else {
            $this->response['message'] = 'El usuario no pudo ser encontrado.';
        }

        return response()->json($this->response, $this->response['status']);
    }

    /**
     * Realiza la actualziacion de los datos del usuario
     */
    public function updated(UserUpdateRequest $request) 
    {
        try {

            Auth::user()->fill([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone
            ]);
            if (!empty($request->password)) {
                Auth::user()->setAttribute('password', bcrypt($request->password));
            }
            if(!Auth::user()->save()) {
                throw new Exception('No se pudo actualizar los datos del usuario.');
            }
            $this->response['status'] = 200;
            $this->response['message'] = 'Los datos del usuario fueron actualizados correctamente.';

        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

    /**
     * Registro de usuarios participantes
     */
    public function createCompetitor(UserRegisterRequest $request)
    {
        try {
            $objUserType = UserType::find(2);
            $objUser = (new User)->fill([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 1
            ]);
            $objUser->type()->associate($objUserType);
            if(!$objUser->save()) {
                throw new Exception('No se pudo crear su usuario');
            }
            $this->response['status'] = 200;
            $this->response['data'] = $objUser->getAttributes();
            Auth::login($objUser);
        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

    /**
     * Verifica si el usuario esta logeado
     */
    public function getAuth()
    {
        if (Auth::check()) {
            return Auth::user()->getAttributes();
        }
        return [];
    }

    public function logout() 
    {
        Auth::logout();
    }

    /**
     * Busqueda de usuarios
     */
    public function search(Request $request)
    {
        $q = $request->q;
        return User::where('name', 'like', "%$q%")
            ->orWhere('email', $q)
            ->orderByRaw('id ASC')
            ->with('type')
            ->get();
    }

}
