<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Account extends Model
{

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'user_id', 
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

        static::creating(function($account){
            $account->id = uuid();
        });
    }

    
    protected function create($request)
    {
        $account = parent::create($request);
        AccountUser::create([
            'user_id' => auth()->user()->id,
            'account_id' => $account->id,
        ]);
        return $account;
    }

    /*
     * Relationships
     */

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permissions::class);
    }

    /*
     * Relationship Aliases
     */
    
    public function owner(){ return $this->user(); }

    /*
     * Custom Functions
     */
    
    public function month()
    {
        return Month::current();
    }

    public function balance($month=null)
    {
        return $this->month()->last()->balance_out + $this->month()->current_balance();
    }
}
