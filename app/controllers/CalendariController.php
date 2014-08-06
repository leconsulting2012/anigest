<?php

class CalendariController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        // Title
        $title = "Calendario";

        return View::make('calendari/index', compact('title'));
	}

    public function getEventi()
    {
        $user = Auth::user();
        $interventi = new Intervento;
        $elenco = $interventi->elencoInterventiPeriodo($user, Input::get('start'), Input::get('end') );
        $elencoNew = array();
        $temp = array();

        foreach ($elenco as $riga) {
            $temp['id'] = $riga->id;
            $temp['title'] = $riga->tipo . " - " . $riga->cognome . " " . $riga->nome;
            $temp['start'] = $riga->dataIntervento;
            $temp['allDay'] = false;
            $temp['durationEditable'] = true;
            $temp['description'] = 'prova';
            $elencoNew[] = $temp;
        }


        return Response::json($elencoNew);
      //  var_dump($elenco);
     //   return json($elenco);
    }


}