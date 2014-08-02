<?php

class WizardsController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;
    protected $antenna;
    protected $user;
    protected $modelloAntenna;
    protected $router;
    protected $modelloRouter;
    protected $installatore;
    protected $anagrafica;
    protected $intervento;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Antenna $antenna, User $user, Intervento $intervento, ModelloAntenna $modelloAntenna, ModelloRouter $modelloRouter, Router $router, Anagrafica $anagrafica)
    {
        parent::__construct();
        $this->antenna = $antenna;
        $this->user = $user;
        $this->modelloAntenna = $modelloAntenna;
        $this->modelloRouter = $modelloRouter;
        $this->router = $router;
        $this->anagrafica = $anagrafica;
        $this->intervento = $intervento;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function index()
	{
        // Title
        $title = "Procedura Wizard \"Aria C/O Terna Servizi\"";

        // Grabbo tutti modelli di Antenna
        $modelliAntenna = $this->modelloAntenna->all(); 

        // Grabbo tutti i modelli di roouters
        $modelliRouters = $this->modelloRouter->all();  

        // Grabbo tutti gli installatori
        $installatori = array();
        $installatori = DB::table('users')->where('users.azienda_id', '=', Auth::user()->azienda_id)->get();


        // Show the page
        //return View::make('routers/index', compact('routers', 'title'));
        return View::make('admin/wizards/aria', compact('title', 'modelliAntenna', 'modelliRouters', 'installatori'));
	}

    public function salva()
    {
        // dichiaro le regole per la validazione
        $rules = array(
            'cognome'       => 'required|min:2|max:100',
            'nome'          => 'min:2|max:50',
            'indirizzo1'    => 'min:2|max:50|required',
            'indirizzo2'    => 'min:2|max:50',
            'cap'           => 'min:5|max:8',
            'citta'         => 'min:2|max:50|required',
            'provincia'     => 'min:2|max:50',
            'telefono'      => 'min:2|max:50|alpha_dash',
            'cellulare'     => 'min:2|max:50|alpha_dash',
            'cfiscale'      => 'min:16|max:16|alpha_dash',
            'modelloAntenna_id'   => 'required|integer',
            'serialeAntenna'       => 'required|unique:antenne,mac',
            'modelloRouter_id'   => 'required|integer',
            'serialeRouter'       => 'required|unique:routers,mac',
            'installatore' => 'integer',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new router
            $user = Auth::user();

            // Update the router data
            $this->router->mac              = Input::get('serialeRouter');
            $this->router->modelliRouter_id  = Input::get('modelloRouter_id');
            $this->router->azienda_id          = Auth::user()->azienda_id;

            $this->antenna->mac                 = Input::get('serialeAntenna');
            $this->antenna->modelloAntenna_id  = Input::get('modelloAntenna_id');
            $this->antenna->azienda_id          = Auth::user()->azienda_id;

            $this->anagrafica->cognome              = strtoupper(Input::get('cognome'));
            $this->anagrafica->nome                 = ucwords(strtolower(Input::get('nome')));
            $this->anagrafica->indirizzo1           = ucwords(strtolower(Input::get('indirizzo1')));
            $this->anagrafica->indirizzo2           = ucwords(strtolower(Input::get('indirizzo2')));
            $this->anagrafica->cap                  = Input::get('cap');
            $this->anagrafica->citta                = strtoupper(Input::get('citta'));
            $this->anagrafica->provincia            = ucwords(strtolower(Input::get('provincia')));
            $this->anagrafica->telefono             = Input::get('telefono');
            $this->anagrafica->cellulare            = Input::get('cellulare');
            $this->anagrafica->azienda_id           = Auth::user()->azienda_id;

            $this->router->azienda_id          = Auth::user()->azienda_id;
            $this->intervento->azienda_id          = Auth::user()->azienda_id;
            $this->intervento->tipiIntervento_id          = 1;

            if($this->router->save()){
                $this->intervento->router_id = DB::getPdo()->lastInsertId();
                if($this->antenna->save()){
                    $this->intervento->antenna_id = DB::getPdo()->lastInsertId();
                    if($this->anagrafica->save()){
                        $this->intervento->anagrafica_id = DB::getPdo()->lastInsertId();
                        if (Input::get('installatore') == '') $this->intervento->user_id = 2;
                        else $this->intervento->user_id = Input::get('installatore');
                        if($this->intervento->save()){
                        // Redirect to the new router page
                            return Redirect::to('wizardAria/')->with('success', 'Salvataggio avvenuto con successo');
                        }
                    }
                    // Redirect to the router page
                    return Redirect::to('wizardAria')->with('error', 'Errore nel salvataggio. Err.no.23425');
                }
                            // Redirect to the router page
                return Redirect::to('wizardAria')->with('error',  'Errore nel salvataggio. Err.no.23426');
            }

        }
        // Form validation failed
        return Redirect::to('wizardAria')->withInput()->withErrors($validator);

    }


}
