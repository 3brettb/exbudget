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
                            <tr data-id='{{$transaction->id}}'>
                                <td><a href='{{request()->url()."/$transaction->id/edit"}}' class="btn btn-default">Edit</a></td>
                                <td>{{\Carbon\Carbon::parse($transaction->date)->format('m\/d\/Y')}}</td>
                                <td>{{$transaction->description}}</td>
                                <td class="rollover category" data-type="category">
                                    @if($transaction->category == null)
                                        <a class="btn btn-default btn-rollover category_set" data-set="false">Set</a>
                                    @else
                                        <a class="category_set" data-set="true" data-val="{{$transaction->category->id}}">{{$transaction->category->name}}</a>
                                    @endif
                                </td>
                                <td class="rollover sub_category" data-type="sub_category">
                                    @if($transaction->sub_category == null)
                                        <a class="btn btn-rollover sub_category_set" data-set="false">Set</a>
                                    @else
                                        <a class="sub_category_set" data-set="true">{{$transaction->sub_category->name}}</a>
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

    <script>
        $(".category_set").on('click', function(){
            category_set_click(this);
        });
        $(".sub_category_set").on('click', function(){
            sub_category_set_click(this);
        });

        function category_set_click(item)
        {
            sub_category_reset(item);
            $.get('{{url("/get/categories")}}', function(data){
                show_select(item, data);
            }, 'json');
        }

        function sub_category_set_click(item)
        {
            category = $(item).parent().siblings('td.category').children('a')[0];
            
            if($(category).data('set') == true){
                $.get('{{url("/get/subcategories")}}', {
                    category: $(category).data('val'),
                }, function(data){
                    show_select(item, data);
                }, 'json');
            }
            else{
                alert('Select a category first');
            }
        }

        function sub_category_reset(a)
        {
            id = $(a).parent().parent().data('id');
            $.post('{{url("/post/transaction")}}/'+id+"/clear_sub_category", {_token:"{{csrf_token()}}"});
            sub = $(a).parent().siblings('td.sub_category').children('a')[0];
            sub_parent = $(sub).parent();
            $(sub).remove();
            n = $('<a class="btn btn-default btn-rollover category_set" data-set="false">Set</a>').on('click', function(){sub_category_set_click(this);});
            $(sub_parent).append(n);
        }

        function get_temp_select()
        {
            temp_select = $('<select>', {class: 'form-control'}).append($("<option>").html("Select an Option"));
            $(temp_select).on('change', function(){
                set_selected($(this).val(), $(this).parent().parent().data('id'), $(this).parent().data('type'));
                a = $(this).siblings('a')[0];
                $(a).html($("option:selected", this).text());
                $(a).removeClass('btn btn-default btn-rollover');
                $(a).data('set', true);
                $(a).data('val', $(this).val());
                $(a).show();
                $(this).remove();
            });
            return temp_select;
        }

        function show_select(a, data)
        {
            if(data.length > 0){
                temp_select = get_temp_select();
                $.each(data, function(i, item){
                    o = $("<option>", {value: item.id}).html(item.name);
                    $(temp_select).append(o);
                });
                $(a).parent().append(temp_select);
                $(a).hide();
            }
            else{
                alert('create a sub category for this category');
            }
        }

        function set_selected(value, id, type)
        {
            switch(type){
                case "category":
                    $.post('{{url("/post/transaction")}}/'+id+"/category", {_token:"{{csrf_token()}}",category_id:value});
                    break;
                case "sub_category":
                    $.post('{{url("/post/transaction")}}/'+id+"/sub_category", {_token:"{{csrf_token()}}",sub_category_id:value});
                    break;
                default:
                    console.error('Tried to set with invalid type.');
            }
        }
    </script>
@endsection