<?php

class RoutersController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;

    /**
     * Post Model
     * @var Post
     */
    protected $router;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * User modelliRouter
     * @var modelliRouter
     */
    protected $modelliRouter;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Router $router, User $user, ModelloRouter $modelliRouter, Azienda $azienda )
    {
        parent::__construct();

        $this->router = $router;
        $this->user = $user;
        $this->modelliRouter = $modelliRouter;
        $this->azienda = $azienda;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
        // Title
        $title = Lang::get('user/routers/title.gestione_routers');

        // Grabbo tutte le routers dell'azienda
        $routers = $this->router->elencoRouters($this->user);

        // Show the page
        return View::make('routers/index', compact('routers', 'title'));
	}

    public function getIndexMagazzino()
    {
        // Title
        $title = "Magazzino Routers";

        // Grabbo tutte le antenne dell'azienda
        $routers = $this->router->elencoRoutersMagazzino($this->user);

        // Show the page
        return View::make('routers/index', compact('routers', 'title'));
    }    

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('user/routers/title.create_a_new_router');

        // Get all the available permissions
        $modelliRouter = $this->modelliRouter->all(); 

        // Mode
        $mode = 'create';                    

        // Selected groups
        $selectedModelloRouter = Input::old('modelliRouter', array());   

        // Show the page
        return View::make('routers/create_edit', compact('title', 'modelliRouter', 'selectedModelloRouter', 'mode'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $router
     * @return Response
     */
	public function getEdit($router)
	{
        // Title
        $title = Lang::get('user/routers/title.router_update');

        // Get all the available permissions
        $modelliRouter = $this->modelliRouter->all();      

        // Mode
        $mode = 'edit';       

        // Selected groups
        $selectedModelliRouter = Input::old('modelliRouter', array());          
        // Show the page
        return View::make('routers/create_edit', compact('router', 'title', 'modelliRouter', 'selectedModelliRouter', 'mode'));
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
            'modelliRouter_id'   => 'required|integer',
            'seriale' => 'required|unique:routers',
            'mac' => 'unique:routers,mac|regex:/^([0-9a-fA-F][0-9a-fA-F][:-]){5}([0-9a-fA-F][0-9a-fA-F])$/'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new router
            $user = Auth::user();

            // Update the router data
            $this->router->mac 				= str_replace("-", ":", Input::get('mac'));
            $this->router->seriale 			= Input::get('seriale');
            $this->router->modelliRouter_id  = Input::get('modelliRouter_id');
            $this->router->azienda_id         = Auth::user()->azienda_id;

            // Was the router created?
            if($this->router->save())
            {
                // Redirect to the new router page
                return Redirect::to('routers/' . $this->router->id . '/edit')->with('success', 'Router inserito correttamente.');
            }
            // Redirect to the router page
            return Redirect::to('routers/create')->with('error', 'Errore E1000');
        } else {
            // Form validation failed
            return Redirect::to('routers/create')->with('error', 'Errore. Controlla i messaggi seguenti.')->withInput()->withErrors($validator);
        }
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($router)
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
            $id = $router->id;
            $router->delete();

            // Was the blog post deleted?
            $router = Router::find($id);
            if(empty($router))
            {
                // Redirect to the blog posts management page
                return Redirect::to('routers')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('routers')->with('error', 'Errore E1001.');
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param $router
     * @return Response
     */
    public function postEdit($router)
    {

        // Declare the rules for the form validation
        $rules = array(           
            'modelliRouter_id' => 'required|integer',
            'mac' => 'regex:/^([0-9a-fA-F][0-9a-fA-F][:-]){5}([0-9a-fA-F][0-9a-fA-F])$/'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $oldRouter = clone $router;
            $router->mac                 = str_replace("-", ":", Input::get('mac'));
            $router->seriale             = Input::get('seriale');
            $router->modelliRouter_id    = Input::get('modelliRouter_id');
            $router->azienda_id          = Auth::user()->azienda_id;


            if($router->save())
            {
                return Redirect::to('routers/' . $router->id . '/edit')->with('success', 'Salvataggio effettuato correttamente.'); 
            } 

            // Rimando alla pagina di errore.
            return Redirect::to('routers/' . $router->id . '/edit')->with('error', 'Errore E1002.')->withInput()->withErrors($validator);
        }

        // Form di validazione fallitto
        return Redirect::to('routers/' . $router->id . '/edit')->withInput()->withErrors($validator);
    }       	

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($router)
    {
        // Title
        $title = Lang::get('user/routers/title.routers_delete');

        // Show the page
        return View::make('routers/delete', compact('router', 'title'));
    }    

    public function getData()
    {
        // estraggo tutti i modelli
        $modelliRouter = $this->modelliRouter->all(); 

        $routers = Router::select(array('routers.id', 'routers.seriale', 'modelliRouter.nome as modello', 'routers.mac', 'routers.updated_at'))
                            ->join('modelliRouter','modelliRouter.id','=', 'routers.modelliRouter_id')
                            ->where('routers.azienda_id', '=', Auth::user()->azienda_id);
        return Datatables::of($routers)

        ->edit_column('updated_at', '{{ formato($updated_at) }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'routers/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'routers/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }
}
