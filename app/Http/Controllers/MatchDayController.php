<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchDayRequest;
use Illuminate\Http\Request;
use App\Model\MatchDay;
use Exception;
use Illuminate\Support\Facades\Auth;

class MatchDayController extends Controller
{

    /**
     * Busqueda del partido
     */
    public function edit($id)
    {
        $objMatchDay = MatchDay::find($id);
        if (empty($objMatchDay)) {
            return [];
        }
        return $objMatchDay->getAttributes();
    }

    /**
     * Devuelve los partidos por jugar
     */
    public function getMatchDay()
    {
        return MatchDay::where('status', '=', 2)->get();
    }

    /**
     * Busqueda de partidos
     */
    public function search(Request $request) 
    {
        $q = $request->q;
        return MatchDay::where('name', 'like', "%$q%")
            ->orderByRaw('created_at DESC')
            ->with('user')
            ->get();
    }

    /**
     * Crea una partida nueva
     */
    public function store(MatchDayRequest $request)
    {
        try {
            if ($request->status != 2 && $request->status != 3) {
                throw new Exception('El estado es invalido.');
            }
            $objMatchDay = (new MatchDay())->fill($request->all());
            $objMatchDay->user()->associate(Auth::user());
            $save = $objMatchDay->save();
            if (!$save) {
                throw new Exception('No se pudo crear el partido.');
            }
            $this->response['status'] = 200;
            $this->response['message'] = "Partido {$objMatchDay->name} creado correctamente.";
        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

    /**
     * Actualiza un partido
     */
    public function update(MatchDayRequest $request)
    {
        try {
            
            $objMatchDay = MatchDay::find($request->id);
            if (empty($objMatchDay)) {
                throw new Exception('El Partido no pudo ser encontrado');
            }
            $objMatchDay->fill($request->all());
            $save = $objMatchDay->save();
            if (!$save) {
                throw new Exception('No se pudo actualizar el partido.');
            }
            $this->response['status'] = 200;
            $this->response['message'] = "Partido {$objMatchDay->name} actualizado correctamente.";
        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

    /**
     * Elimina un partido
     */
    public function remove(Request $request)
    {
        try {
            
            $objMatchDay = MatchDay::find($request->id);
            if (empty($objMatchDay)){
                throw new Exception('El partido no pudo ser encontrado.');
            }
            if ($objMatchDay->status !== 3) {
                throw new Exception('El partido no puede ser eliminado por que no esta en borrador.');
            }
            $objMatchDay->delete();
            $this->response['status'] = 200;
            $this->response['message'] = "Partido {$objMatchDay->name} fue eliminado correctamente."; 

        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

}
