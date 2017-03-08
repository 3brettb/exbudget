<?php
    $a = new \stdClass();
    $b = new \stdClass();
    $c = new \stdClass();
    $a->month = "January";
    $a->expenses = "3";
    $a->income = "2";
    $b->month = "February";
    $b->expenses = "2";
    $b->income = "1";
    $c->month = "March";
    $c->expenses = "4";
    $c->income = "5";
    $data = array($a, $b, $c);
?>
@extends('layouts.app')

@section('title')
    Account Dashboard
@endsection

@section('google-visualization')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @include('data.dashboard.income_expense_curves', array("data"=>$data, "chart" => array("0px", "0px", "80%", "80%")))
    @include('data.dashboard.spending_areas_pie', array("chart" => array("0px", "0px", "80%", "80%")))
@endsection

@section('content')
    <?php $account = auth()->user()->account(); ?>

    <h2>Account Balance: ${{$account->balance()}}</h2>

    <h2>Current Month Balance: ${{$account->month()->current_balance()}}</h2>

    <h4>Past 3 Months</h4>
    <div id="income_expense_curves" style="width: 350px; height: 200px"></div>

    <h4>Monthly Spending Areas</h4>
    <div id="spending_areas_pie" style="width: 350px; height: 200px"></div>

    <button data-toggle="collapse" data-target="#recent_transactions">Recent Transactions</button>
    <div id="recent_transactions" class="collapse">
        <table>
            <thead>
                <th>Head 1</th>
                <th>Head 2</th>
                <th>Head 3</th>
                <th>Head 4</th>
            </thead>
            <tbody>
                <tr>
                    <td>Col 1</td>
                    <td>Col 2</td>
                    <td>Col 3</td>
                    <td>Col 4</td>
                </tr>
                <tr>
                    <td>Col 1</td>
                    <td>Col 2</td>
                    <td>Col 3</td>
                    <td>Col 4</td>
                </tr>
                <tr>
                    <td>Col 1</td>
                    <td>Col 2</td>
                    <td>Col 3</td>
                    <td>Col 4</td>
                </tr>
                <tr>
                    <td>Col 1</td>
                    <td>Col 2</td>
                    <td>Col 3</td>
                    <td>Col 4</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4>Top 5 Monthly Categories</h4>
    <ol>
        <li><a href="#subcategory">Tuition</a> (<a href="#category">School</a>): <b>$ 634.00</b></li>
        <li><a href="#subcategory">Grocery</a> (<a href="#category">Food</a>) : <b>$ 354.25</b></li>
        <li><a href="#subcategory">Fuel</a> (<a href="#category">Transportation</a>): <b>$ 81.42</b></li>
        <li><a href="#subcategory">Fast Food</a> (<a href="#category">Food</a>): <b>$ 78.34</b></li>
        <li><a href="#subcategory">Eating Out</a> (<a href="#category">Food</a>): <b>$ 64.23</b></li>
    </ol>

    <a id="uploadTransactions" class="btn btn-default">Upload Transactions CSV</button>
    <a id="addTransaction" class="btn btn-default">Add Transaction</button>

@endsection