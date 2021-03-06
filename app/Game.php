<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function players()
	{
		return $this->hasMany('Dixit\Player', 'fk_games', 'pk_id');
	}
        public function users()
        {
            return $this->belongsToMany('Dixit\User', 'players', 'fk_games', 'fk_user_id')->withPivot('pk_id');
        }  

	public function turns()
	{
		return $this->hasMany('Dixit\Turn', 'fk_games', 'pk_id');
	}

	public function decks()
	{
		return $this->belongsToMany('Dixit\Deck', 'games_based_on_decks', 'fk_games', 'fk_decks');
	}
        public function playersId()
        {
            return $this->hasMany('Dixit\Player', 'fk_games', 'pk_id')->select('fk_user_id');
        }

	protected $table = 'games';
    protected $primaryKey = 'pk_id';
	protected $fillable = array('name', 'language', 'no_players' ,'started', 'turn_timeout', 'id_owner');

}
