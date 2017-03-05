<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Month extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month', 'year', 'date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function month()
    {
        return Carbon::parse($this->month);
    }

    public function year()
    {
        return Carbon::parse($this->year);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
