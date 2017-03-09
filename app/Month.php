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
        'month', 'year', 'date', 'balance_in', 'balance_out'
    ];

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

    /*
     * Custom Functions
     */

    public static function current()
    {
        return self::resolve_month(Carbon::now());
    }

    public function last()
    {
        return self::resolve_month(Carbon::parse($this->month." ".$this->year)->subMonth());
    }

    public function get($parser)
    {
        return self::resolve_month(Carbon::parse($parser));
    }

    public function transactions()
    {
        $start = $this->month()->startOfMonth();
        $end = $this->month()->endOfMonth();
        return Transaction::where('date', '>=', $start)->where('date', '<=', $end)->where('category_id', '!=', null)->get();
    }

    public function current_balance()
    {
        $balance = ($this->balance_in == null) ? 0 : $this->balance_in;
        $transactions = $this->transactions();
        foreach($transactions as $trans){
            $mult = $trans->category->multiplier;
            $balance += (float)($trans->amount*$mult);
        }
        return $balance;
    }

    private static function resolve_month($carbon)
    {
        $month = $carbon->format('F');
        $year = $carbon->format('Y');
        return parent::where('month', $month)->where('year', $year)->first();
    }
}
