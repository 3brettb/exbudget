<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class GetController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function subcategories()
    {
        $id = (isset($_GET['category'])) ? $_GET['category'] : null;
        return auth()->user()->account()->categories()->where('id', $id)->first()->sub_categories;
    }
}
