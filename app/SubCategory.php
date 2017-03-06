<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'account_id', 'category_id',
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

        static::creating(function($sub){
            $sub->id = uuid();
        });
    }

    /*
     * Relationships
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
