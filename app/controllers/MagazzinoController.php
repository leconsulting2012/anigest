<?php

class MagazzinoController extends \BaseController {

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
        $title = 'Magazzino';

        // Grabbo tutte le interventi dell'azienda
      //  $interventi = $this->intervento->elencoInterventiDaCompletare();
        $operatori = $this->user->getAllOthersUsers();

        $totTuoiRouter = $this->router->totMioMagazzino(Auth::user()->id);
        $totTueAntenne = $this->antenna->totMioMagazzino(Auth::user()->id);

        $totTuoMagazzino = $totTuoiRouter;

        // Show the page
        return View::make('magazzino/index', compact('totTuoMagazzino', 'operatori', ' totAntenneMagazzino', 'interventi', 'title', 'totAnagrafiche', 'totInterventi'));
    }

    public function getNonAssegnatiAntenne()
    {
        $elencoNonAssegnateAntenne = $this->antenna->inMagazzino();
        return Response::json($elencoNonAssegnateAntenne);        
    }    

    public function getNonAssegnatiRouters()
    {
        $elencoNonAssegnateRouters = $this->router->inMagazzino();
        return Response::json($elencoNonAssegnateRouters);        
    }         

    public function getElencoMaterialeDaConsegnareAntenne($user)
    {
        $elencoAntenne = $this->antenna->daConsegnareUtente($user->id);
        return Response::json($elencoAntenne);        
    }

    public function getElencoMaterialeDaConsegnareRouters($user)
    {
        $elencoRouters = $this->router->daConsegnareUtente($user->id);
        return Response::json($elencoRouters);        
    }

    public function getTuoMagazzinoAntenne()
    {
        $elencoDaTeAntenne = $this->antenna->elencoDaTe();
        return Response::json($elencoDaTeAntenne);        
    }  

    public function getTuoMagazzinoRouters()
    {
        $elencoRouters = $this->router->elencoDaTe();
        return Response::json($elencoRouters);        
    }     

    public function consegnaAntenna($user, $antenna)
    {
        $antenna->dataConsegna = date("Y-m-d H:i:s");
        $antenna->magazzino_id = $user->id;
        if ($antenna->save())
            return 'ok';
        else return 'ko';
    }   

    public function consegnaRouter($user, $router)
    {
        $router->dataConsegna = date("Y-m-d H:i:s");
        $router->magazzino_id = $user->id;
        if ($router->save())
            return 'ok';
        else return 'ko';
    }      
}