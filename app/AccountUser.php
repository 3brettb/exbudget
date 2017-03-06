<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountUser extends Model
{

    public $incrementing = false;
    
    public $table = 'account_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'user_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($account_user){
            $account_user->id = uuid();
        });
    }

    protected function create($request)
    {
        return parent::create([
            'account_id' => $request['account_id'],
            'user_id' =>$request['user_id']
        ]);
    }
}
