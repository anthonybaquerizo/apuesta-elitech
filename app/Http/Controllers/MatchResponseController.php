<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\MatchResponse;
use App\Model\MatchDay;
use Exception;

class MatchResponseController extends Controller
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
     * Devuelve los partidos jugados por el usuario
     */
    public function getResponses()
    {
        return Auth::user()->matchResponses;
    }

    /**
     * Se guarda la paticipacion del usuario
     */
    public function saveParticipate(Request $request)
    {
        try {
            $idMatchDay = $request->match_day_id;
            $answer = $request->answer;
            $objMatchDay = MatchDay::find($idMatchDay);
            if (empty($objMatchDay)) {
                throw new Exception('El partido no pudo ser encontrado');
            }
            if ($answer != 1 && $answer != 2 && $answer != 3) {
                throw new Exception('La respuesta es invalido');
            }
            
            $validate = MatchResponse::where('match_day_id', '=', $objMatchDay->getKey())
                ->where('user_id', '=', Auth::user()->getKey())
                ->get();
            if (!$validate->isEmpty()) {
                throw new Exception('Ya participaste en el partido.');
            }
            
            $objMatchDayResponse = new MatchResponse();
            $objMatchDayResponse->fill([
                'answer' => $answer,
            ]);
            $objMatchDayResponse->user()->associate(Auth::user());
            $objMatchDayResponse->matchDay()->associate($objMatchDay);
            $save = $objMatchDayResponse->save();
            if (!$save) {
                throw new Exception('No se pudo guardar tu participación.');
            }
            $this->response['status'] = 200;
            $this->response['message'] = "Gracias por participar en: {$objMatchDay->name}";
        } catch (Exception $ex) {
            $this->response['message'] = $ex->getMessage();
        }
        return response()->json($this->response, $this->response['status']);
    }

}
