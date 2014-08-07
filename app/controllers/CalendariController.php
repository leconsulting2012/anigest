<?php

class CalendariController extends \BaseController {

    protected $intervento;

    public function __construct(Intervento $intervento)
    {
        parent::__construct();
        $this->intervento = $intervento;
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
            $temp['end'] = $riga->dataFineIntervento;
            $temp['allDay'] = false;
            $temp['durationEditable'] = true;
            $temp['description'] = 'prova';
            $elencoNew[] = $temp;
        }
        return Response::json($elencoNew);
    }

    public function updateEvento($intervento)
    {
        $user = Auth::user();

        $oldIntervento = clone $intervento;      
        $intervento->tipiIntervento_id   = Input::get('tipiIntervento_id');
        $intervento->antenna_id                      = Input::get('antenna_id');
        $intervento->router_id                    = Input::get('router_id');
        $intervento->anagrafica_id                  = Input::get('anagrafica_id');

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


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
    }
}