<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash', 'date', 'amount', 'description', 'notes', 'category_id', 'sub_category_id', 'account_id', 
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($transaction){
            $transaction->id = uuid();
            $transaction->hash = "hash the request";
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /*
     * Relationships
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
