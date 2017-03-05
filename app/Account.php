<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'description', 'user_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

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
}
