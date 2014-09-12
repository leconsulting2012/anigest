<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Magazzino extends Eloquent {
   // use SoftDeletingTrait;
	protected $table = 'magazzino';

	public function getAntenne($user = 0)
    {
        return $this->where('azienda_id', '=', $user->azienda_id )
        			->where('materiale', '=', 'a');
    }

	

}