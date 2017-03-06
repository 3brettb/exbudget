<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'description', 'category_id', 'sub_category_id', 'month_id', 'account_id', 
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

        static::creating(function($budget){
            $budget->id = uuid();
        });
    }

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
