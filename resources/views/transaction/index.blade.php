@extends('layouts.app')

@section('title')
    Transactions
@endsection

@section('style')
    table tr > td{
        min-height: 20px;
        padding: 3px 0px;
    }
@endsection

@section('content')
    <div class="container">
        <div class='row'>
            <div class='col-md-6'>
                <h3>Transactions</h3>
            </div>
            <div class='col-md-6'>
                <span class='pull-right'>
                    {{$transactions->links()}}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table width="100%" class='table-striped'>
                    <thead>
                        <th></th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Amount</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td><a href='{{request()->url()."/$transaction->id/edit"}}' class="btn btn-default">Edit</a></td>
                                <td>{{\Carbon\Carbon::parse($transaction->date)->format('m\/d\/Y')}}</td>
                                <td>{{$transaction->description}}</td>
                                <td align="center" class="rollover">
                                    @if($transaction->category == null)
                                        <a class="btn btn-default btn-rollover">Set</a>
                                    @else
                                        <a href="#">{{$transaction->category}}</a>
                                    @endif
                                </td>
                                <td align="center" class="rollover">
                                    @if($transaction->sub_category == null)
                                        <a class="btn btn-rollover">Set</a>
                                    @else
                                        <a href="#">{{$transaction->sub_category}}</a>
                                    @endif
                                </td>
                                <td>{{$transaction->amount}}</td>
                                <td align='right'><a href='{{request()->url()."/$transaction->id/delete"}}' class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('transaction.modal.set_category', array('id'=>'set_category_modal'))
    @include('transaction.modal.set_sub_category', array('id'=>'set_sub_category_modal'))
@endsection