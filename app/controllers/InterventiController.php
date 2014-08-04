<?php

class InterventiController extends AdminController {

    /**
     * Anagrafica Model
     * @var Anagrafica
     */
    protected $anagrafica;

    /**
     * Antenna Model
     * @var Antenna
     */
    protected $antenna;

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;

    /**
     * Post Model
     * @var Post
     */
    protected $intervento;

    /**
     * User Model
     * @var User
     */
    protected $user;
    protected $router;
    protected $modelloIntervento;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(ModelloIntervento $modelloIntervento, Intervento $intervento, User $user, Azienda $azienda, Antenna $antenna, Router $router, Anagrafica $anagrafica )
    {
        parent::__construct();

        $this->intervento = $intervento;
        $this->user = $user;
        $this->antenna = $antenna;
        $this->azienda = $azienda;
        $this->router = $router;
        $this->anagrafica = $anagrafica;
        $this->modelloIntervento = $modelloIntervento;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
        // Title
        $title = Lang::get('user/interventi/title.gestione_interventi');

        // Grabbo tutte le interventi dell'azienda
        $interventi = $this->intervento->elencoInterventi($this->user);

        // Show the page
        return View::make('interventi/index', compact('interventi', 'title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('user/interventi/title.create_a_new_intervento');
        $user = $this->user->currentUser();


        // Get all the available permissions
        $modelliIntervento = $this->modelloIntervento->all();

        // Get all the available antenne
        $antenne = $this->antenna->elencoAntenneDisponibili($user); 
        $antenne = array();
        $antenne = DB::table('antenne')->where('antenne.azienda_id', '=', Auth::user()->azienda_id)->get();

        // Get all the available routers 
        $routers = array();
        $routers = DB::table('routers')->where('routers.azienda_id', '=', Auth::user()->azienda_id)->get(); 

        // Get all the available clienti
        $anagrafiche = array();
        $anagrafiche = DB::table('anagrafiche')->where('anagrafiche.azienda_id', '=', Auth::user()->azienda_id)->get();

        // Grabbo tutti gli installatori
        $installatori = array();
        $installatori = DB::table('users')->where('users.azienda_id', '=', Auth::user()->azienda_id)->get();             

        // Mode
        $mode = 'create';                      

        // Show the page
        return View::make('interventi/create_edit', compact('intervento', 'installatori', 'anagrafiche', 'antenne', 'intervento', 'routers', 'title', 'modelliIntervento', 'selectedModelloIntervento', 'mode'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $intervento
     * @return Response
     */
	public function getEdit($intervento)
	{
        $user = $this->user->currentUser();

        // Title
        $title = Lang::get('user/interventi/title.intervento_update');

        // Get all the available permissions
        $modelliIntervento = $this->modelloIntervento->all();

        // Get all the available antenne
        $antenne = $this->antenna->elencoAntenneDisponibili($user); 
        $antenne = array();
        $antenne = DB::table('antenne')->where('antenne.azienda_id', '=', Auth::user()->azienda_id)->get();

        // Get all the available routers 
        $routers = array();
        $routers = DB::table('routers')->where('routers.azienda_id', '=', Auth::user()->azienda_id)->get(); 

        // Get all the available clienti
        $anagrafiche = array();
        $anagrafiche = DB::table('anagrafiche')->where('anagrafiche.azienda_id', '=', Auth::user()->azienda_id)->get();

        // Grabbo tutti gli installatori
        $installatori = array();
        $installatori = DB::table('users')->where('users.azienda_id', '=', Auth::user()->azienda_id)->get(); 

        // Modifico il formato delle date
        $format = 'Y-m-d H:i:s';
        $date = DateTime::createFromFormat($format, $intervento->dataIntervento);
        if($date != FALSE) $intervento->dataIntervento = $date->format('d-m-Y H:i');

        // Mode
        $mode = 'edit';       

        // Selected groups
        $selectedModelloIntervento = Input::old('modelloIntervento', array());          
        // Show the page
        return View::make('interventi/create_edit', compact('intervento', 'installatori', 'anagrafiche', 'antenne', 'intervento', 'routers', 'title', 'modelliIntervento', 'selectedModelloIntervento', 'mode'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
        $rules = array(
           // 'modelloIntervento_id'   => 'required|integer',
            'ip'   => 'regex:[\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b]',
            'tipiIntervento_id' => 'required|integer',

        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new intervento
            $user = Auth::user();

            // Update the intervento data
            $this->intervento->tipiIntervento_id 				      = Input::get('tipiIntervento_id');
            $this->intervento->antenna_id 			           = Input::get('antenna_id');
            $this->intervento->router_id                    = Input::get('router_id');
            $this->intervento->anagrafica_id       			  = Input::get('anagrafica_id');
            $this->intervento->user_id                  = Input::get('user_id');
            $this->intervento->confermato                  = Input::get('confermato');
            $this->intervento->completato                  = Input::get('completato');
            $this->intervento->priorita                  = '1';
            $this->intervento->consegnaACPE                  = 0;
            $this->intervento->note                  = Input::get('note');
            $this->intervento->ip                  = Input::get('ip');
            $this->intervento->bsid                   = Input::get('bsid');
            $this->intervento->rssi    			      = Input::get('rssi');
            $this->intervento->cmri    			      = Input::get('cmri');
            $this->intervento->azienda_id             = Auth::user()->azienda_id;

            // Modifico il formato delle date
            $format = 'd/m/Y H:i';
            $date = DateTime::createFromFormat($format, Input::get('dataIntervento'));
            if($date != FALSE) $this->intervento->dataIntervento = $date->format('Y-m-d H:i:s');

            // Was the intervento created?
            if($this->intervento->save())
            {
                // Redirect to the new intervento page
                return Redirect::to('interventi/' . $this->intervento->id . '/edit')->with('success', Lang::get('user/interventi/messages.create.success'));
            }

            // Redirect to the intervento page
            return Redirect::to('interventi/create')->with('error', Lang::get('user/interventi/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('interventi/create')->withInput()->withErrors($validator);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($intervento)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $intervento->id;
            $intervento->delete();

            // Was the blog post deleted?
            $intervento = Intervento::find($id);
            if(empty($intervento))
            {
                // Redirect to the blog posts management page
                return Redirect::to('interventi')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('interventi')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param $intervento
     * @return Response
     */
    public function postEdit($intervento)
    {
        // Declare the rules for the form validation
        $rules = array(
            'modelloIntervento_id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $oldIntervento = clone $intervento;
            $intervento->mac                 = Input::get('mac');
            $intervento->seriale             = Input::get('seriale');
            $intervento->modelloIntervento_id  = Input::get('modelloIntervento_id');
            $intervento->ip                  = Input::get('ip');
            $intervento->bsid                = Input::get('bsid');
            $intervento->rssi                = Input::get('rssi');
            $intervento->cmri                = Input::get('cmri');
            $intervento->azienda_id          = Auth::user()->azienda_id;

            // Modifico il formato delle date
            $format = 'd-m-Y H:i';
            $date = DateTime::createFromFormat($format, Input::get('dataIntervento'));  
            if($date != FALSE) $this->intervento->dataIntervento = $date->format('Y-m-d H:i:s');            

            if($intervento->save()){
                return Redirect::to('interventi/' . $intervento->id . '/edit')->with('error', Lang::get('users/interventi/messages.edit.error'));
            } else {
                return Redirect::to('interventi/' . $intervento->id . '/edit')->with('error', Lang::get('users/interventi/messages.edit.error'))->withInput()->withErrors($validator);
            }
        }
        return Redirect::to('interventi/' . $intervento->id . '/edit')->with('error', Lang::get('users/interventi/messages.edit.error'))->withInput()->withErrors($validator);
    }       	

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($intervento)
    {
        // Title
        $title = Lang::get('user/interventi/title.interventi_delete');

        // Show the page
        return View::make('interventi/delete', compact('intervento', 'title'));
    }    

    public function getData()
    {
        // estraggo tutti i modelli
        //$modelliIntervento = $this->modelloIntervento->all(); 

        $interventi = Intervento::select(array('interventi.id', 'anagrafiche.cognome as cognome', 'interventi.dataIntervento', 'users.username', 'interventi.confermato', 'interventi.completato'))
                            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                            ->join('users','users.id','=', 'interventi.user_id')
                            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id);
        return Datatables::of($interventi)

        ->edit_column('confermato','@if($confermato == 0)
                    <span class="glyphicon glyphicon-thumbs-down"></span>
                @else
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                @endif')

        ->edit_column('completato','@if($completato == 0)
                    <span class="glyphicon glyphicon-thumbs-down"></span>
                @else
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                @endif')        

        //->edit_column('updated_at', Carbon::createFromFormat('Y/m/d H:i:s', time()))

        ->add_column('actions', '<a href="{{{ URL::to(\'interventi/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'interventi/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }
}
