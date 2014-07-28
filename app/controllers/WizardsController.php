<?php

class WizardsController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;



    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct( )
    {
        parent::__construct();

    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function index()
	{
        // Title
        $title = Lang::get('user/routers/title.gestione_routers');

        // Grabbo tutte le routers dell'azienda
        //$routers = $this->router->elencoRouters($this->user);

        // Show the page
        //return View::make('routers/index', compact('routers', 'title'));
        return View::make('admin/wizards/aria', compact('title'));
	}



    public function getData()
    {
        // estraggo tutti i modelli
        $modelliRouter = $this->modelliRouter->all(); 

        $routers = Router::select(array('routers.id', 'routers.seriale', 'modelliRouter.nome as modello', 'routers.updated_at'))
                            ->join('modelliRouter','modelliRouter.id','=', 'routers.modelliRouter_id')
                            ->where('routers.azienda_id', '=', Auth::user()->azienda_id);
        return Datatables::of($routers)

        //->edit_column('updated_at', Carbon::createFromFormat('Y/m/d H:i:s', time()))

        ->add_column('actions', '<a href="{{{ URL::to(\'routers/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'routers/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }
}
