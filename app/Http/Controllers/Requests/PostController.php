<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use App\Http\Controllers\Controller;

use App\Transaction;

class PostController extends Controller
{

    protected $file_types = ["csv"];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function transaction(Request $request)
    {
        if($request->hasFile('file')){
            $filename = $request->file('file')->getrealPath();
            return self::add_csv($filename);
        }
        return self::add_transaction($request);
    }

    public function transaction_category(Transaction $transaction, Request $request)
    {
        $transaction->category_id = $request->category_id;
        $transaction->save();
    }

    public function transaction_sub_category(Transaction $transaction, Request $request)
    {
        $transaction->sub_category_id = $request->sub_category_id;
        $transaction->save();
    }

    public function transaction_clear_sub_category(Transaction $transaction)
    {
        $transaction->sub_category_id = null;
        $transaction->save();
    }

    private function add_transaction($request)
    {
        try{
            auth()->user()->account()->transactions()->create([
                'date'=>$request->date,
                'amount'=>$request->amount,
                'notes'=>$request->notes,
            ]);
        }
        catch(QueryException $e){
            return "false";
        }
        return "true";
    }

    private function add_csv($filename)
    {
        $f = fopen($filename, "r");
        $all_data = [];
        $cols = fgetcsv($f);
        while ( ($data = fgetcsv($f)) !==FALSE ){
            $initial = (float)$data[4];
            $value = ($data[0] == "Payment") ? $initial : $initial*(-1);
            
            try{
                auth()->user()->account()->transactions()->create([
                    'date'=> $data[1],
                    'amount'=> $value,
                    'description'=> $data[0].": ".$data[3],
                ]);
            }
            catch(QueryException $e){
                //already exists, skip
                continue;
            }
        }
        fclose($f);

        return "true";
    }
}
