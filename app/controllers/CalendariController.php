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

    public function updateEvento()
    {
        $user = Auth::user();
        $i = new Intervento;
        $intervento = $i->find((int)Input::get('id'));

        $oldIntervento = clone $intervento;      
        $intervento->dataFineIntervento              = Input::get('start');
        $intervento->dataFineIntervento              = Input::get('end');

        if($intervento->save()){
            var_dump($intervento);
            echo 'salvato correttamente';
            var_dump(Input::get('start'));
            var_dump(Input::get('end'));
        } else {
            
        }
    }
}