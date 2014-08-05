<?php

class AntenneController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;

    /**
     * Post Model
     * @var Post
     */
    protected $antenna;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * User modelloAntenna
     * @var modelloAntenna
     */
    protected $modelloAntenna;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Antenna $antenna, User $user, ModelloAntenna $modelloAntenna, Azienda $azienda )
    {
        parent::__construct();

        $this->antenna = $antenna;
        $this->user = $user;
        $this->modelloAntenna = $modelloAntenna;
        $this->azienda = $azienda;
    }


	public function getIndex()
	{
        // Title
        $title = Lang::get('user/antenne/title.gestione_antenne');

        // Grabbo tutte le antenne dell'azienda
        $antenne = $this->antenna->elencoAntenne($this->user);

        // Show the page
        return View::make('antenne/index', compact('antenne', 'title'));
	}

    public function getIndexMagazzino()
    {
        // Title
        $title = "Magazzino Antenne";

        // Grabbo tutte le antenne dell'azienda
        $antenne = $this->antenna->elencoAntenneMagazzino($this->user);

        // Show the page
        return View::make('antenne/index', compact('antenne', 'title'));
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('user/antenne/title.create_a_new_antenna');

        // Get all the available permissions
        $modelliAntenna = $this->modelloAntenna->all(); 

        // Mode
        $mode = 'create';                    

        // Selected groups
        $selectedModelloAntenna = Input::old('modelloAntenna', array());   

        // Show the page
        return View::make('antenne/create_edit', compact('title', 'modelliAntenna', 'selectedModelloAntenna', 'mode'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $antenna
     * @return Response
     */
	public function getEdit($antenna)
	{
        // Title
        $title = Lang::get('user/antenne/title.antenna_update');

        // Get all the available permissions
        $modelliAntenna = $this->modelloAntenna->all();

        // Modifico il formato delle date
        $format = 'Y-m-d H:i:s';

        if($antenna->dataRicezione != '0000-00-00 00:00:00') 
        {
            $date = DateTime::createFromFormat($format, $antenna->dataRicezione);    
            if($date != FALSE) $antenna->dataRicezione = $date->format('d-m-Y H:i');  
        } else
        {
            $antenna->dataRicezione = '';
        }
   
        if($antenna->dataConsegna != '0000-00-00 00:00:00') 
        {
            $date = DateTime::createFromFormat($format, $antenna->dataConsegna);    
            if($date != FALSE) $antenna->dataConsegna = $date->format('d-m-Y H:i');  
        } else
        {
            $antenna->dataConsegna = '';
        }

        if($antenna->dataMontaggio != '0000-00-00 00:00:00') 
        {
            $date = DateTime::createFromFormat($format, $antenna->dataMontaggio);    
            if($date != FALSE) $antenna->dataMontaggio = $date->format('d-m-Y H:i');  
        } else
        {
            $antenna->dataMontaggio = '';
        }

        // Mode
        $mode = 'edit';       

        // Selected groups
        $selectedModelloAntenna = Input::old('modelloAntenna', array());          
        // Show the page
        return View::make('antenne/create_edit', compact('antenna', 'title', 'modelliAntenna', 'selectedModelloAntenna', 'mode'));
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
            'modelloAntenna_id'   => 'required|integer',
            'seriale' => 'required',
            'mac' => 'unique:antenne,mac|regex:/^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new antenna
            $user = Auth::user();

            // Update the antenna data
            $this->antenna->mac 				= Input::get('mac');
            $this->antenna->seriale 			= Input::get('seriale');
            $this->antenna->modelloAntenna_id  = Input::get('modelloAntenna_id');
            $this->antenna->azienda_id          = Auth::user()->azienda_id;

            // Modifico il formato delle date
            $format = 'd/m/Y H:i';
            $date = DateTime::createFromFormat($format, Input::get('dataRicezione'));  
            if($date != FALSE) $this->antenna->dataRicezione = $date->format('Y-m-d H:i:s');

            $date = DateTime::createFromFormat($format, Input::get('dataConsegna'));  
            if($date != FALSE) $this->antenna->dataConsegna = $date->format('Y-m-d H:i:s');

            $date = DateTime::createFromFormat($format, Input::get('dataMontaggio'));  
            if($date != FALSE) $this->antenna->dataMontaggio = $date->format('Y-m-d H:i:s');                          

            // Was the antenna created?
            if($this->antenna->save())
            {
                // Redirect to the new antenna page
                return Redirect::to('antenne/' . $this->antenna->id . '/edit')->with('success', 'Antenna create con successo.');
            }

            // Redirect to the antenna page
            return Redirect::to('antenne/create')->with('error', 'Errore E3000.');
        }

        // Form validation failed
        return Redirect::to('antenne/create')->withInput()->withErrors($validator);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($antenna)
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
            $id = $antenna->id;
            $antenna->delete();

            // Was the blog post deleted?
            $antenna = Antenna::find($id);
            if(empty($antenna))
            {
                // Redirect to the blog posts management page
                return Redirect::to('antenne')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('antenne')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param $antenna
     * @return Response
     */
    public function postEdit($antenna)
    {
        // Declare the rules for the form validation
        $rules = array(
            'modelloAntenna_id' => 'required|integer',
            'mac' => 'regex:/^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/',
           // 'dataRicezione' => 'regex:/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}/',
       //     'dataConsegna' => 'regex:/^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-./])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/',
       //     'dataMontaggio' => 'regex:/^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-./])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $oldAntenna = clone $antenna;
            $antenna->mac                 = Input::get('mac');
            $antenna->seriale             = Input::get('seriale');
            $antenna->modelloAntenna_id   = Input::get('modelloAntenna_id');
            $antenna->azienda_id          = Auth::user()->azienda_id;

            // Modifico il formato delle date
            $format = 'd/m/Y H:i';
            $date = DateTime::createFromFormat($format, Input::get('dataRicezione'));  
            if($date != FALSE) $antenna->dataRicezione = $date->format('Y-m-d H:i:s');

            $date = DateTime::createFromFormat($format, Input::get('dataConsegna'));  
            if($date != FALSE) $antenna->dataConsegna = $date->format('Y-m-d H:i:s');

            $date = DateTime::createFromFormat($format, Input::get('dataMontaggio'));  
            if($date != FALSE) $antenna->dataMontaggio = $date->format('Y-m-d H:i:s');               

            // Was the antenna created?
            if($antenna->save())
            {
                // Redirect to the new antenna page
                return Redirect::to('antenne/' . $antenna->id . '/edit')->with('success', 'antenna inserito correttamente.');
            } else
            {
            // Redirect to the antenna page
            return Redirect::to('antenne/' . $antenna->id . '/edit')->with('error', 'Errore E3000');
            }
        } else {
            // Form validation failed
            return Redirect::to('antenne/' . $antenna->id . '/edit')->withInput()->withErrors($validator);
        }
    }       	

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($antenna)
    {
        // Title
        $title = Lang::get('user/antenne/title.antenne_delete');

        // Show the page
        return View::make('antenne/delete', compact('antenna', 'title'));
    }    

    public function getData()
    {
        // estraggo tutti i modelli
        $modelliAntenna = $this->modelloAntenna->all(); 

        $antenne = Antenna::select(array('antenne.id', 'antenne.seriale', 'modelliAntenna.nome as modello', 'antenne.mac', 'antenne.updated_at'))
                            ->join('modelliAntenna','modelliAntenna.id','=', 'antenne.modelloAntenna_id')
                            ->where('antenne.azienda_id', '=', Auth::user()->azienda_id);
        return Datatables::of($antenne)

        //->edit_column('updated_at', Carbon::createFromFormat('Y/m/d H:i:s', time()))

        ->add_column('actions', '<a href="{{{ URL::to(\'antenne/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'antenne/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }
}
