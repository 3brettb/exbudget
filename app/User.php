<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permissions::class);
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
