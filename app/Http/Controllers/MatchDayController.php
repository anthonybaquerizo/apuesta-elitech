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
     * Devuelve los partidos por jugar
     */
    public function getMatchDay()
    {
        return MatchDay::where('status', '=', 2)->get();
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

}
