<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'account_id', 
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

        static::creating(function($tag){
            $tag->id = uuid();
        });
    }

    /*
     * Relationships
     */

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
