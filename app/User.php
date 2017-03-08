<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->id = uuid();
        });
    }

    /*
     * Relationships
     */

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permissions::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    /*
     * Custom Functions
     */

    public function account()
    {
        return Account::findOrFail(session()->get('account_id'));
    }
    
    public function generate_user_token($type, $size=60)
    {
        switch($type){
            case 'api':
                $this->api_token = str_random($size);
                $this->save();
                return true;
            default:
                return false;
        }
    }

    public function revoke_user_token($type)
    {
        switch($type)
        {
            case 'api':
                $this->api_token = null;
                $this->save();
                return true;
            default:
                return false;
        }
    }

    
}
