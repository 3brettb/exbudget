@extends('layouts.app')

@section('title')
    User Accounts
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <a class="btn btn-primary" href="{{url('/account/create')}}">Create Account</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Accounts</h2>
                        <hr>
                    </div>
                </div>
                @foreach($accounts as $account)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <a href="{{url("/account/$account->id")}}">{{$account->name}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection