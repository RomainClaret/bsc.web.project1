<?php

namespace Dixit;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','username', 'email', 'password', 'question', 'answer'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'answer', 'remember_token'];
    
    public function games()
    {
        return $this->belongsToMany('Dixit\Game', 'players', 'fk_user_id', 'fk_games')->withPivot('pk_id');
    }  
    public function players()
    {
	return $this->hasMany('Dixit\Player', 'fk_user_id', 'id');
    }
            
    
}
