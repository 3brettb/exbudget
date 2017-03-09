<div class="modal fade message-modal" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Create Transaction</h4>
        </div>
        <div class="modal-body">
            
            <form class="form-horizontal" id="{{$id}}_form" role="form">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="col-md-3 control-label">Transaction Amount</label>

                    <div class="col-md-6">
                        <input id="amount" type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount') }}" required>

                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-3 control-label">Transaction Category</label>

                    <div class="col-md-6">
                        <?php $category_select = array_merge(['0' => 'Select a Category'], auth()->user()->account()->categories()->pluck('name', 'id')->toArray()); ?>
                        {!! Form::select('category', $category_select, 0, ['id'=>'category', 'class' => 'form-control', 'required' => 'required', 'name' => 'category']) !!}
                        <script>
                            $("#category").on('change', function(){
                                if($("#category").val() != 0){
                                    $.get('{{url("/get/subcategories")}}', {
                                        category: $("#category").val(),
                                    }, function(data){
                                        if(data.length > 0){
                                            $('#subcategory').prop('disabled', false);
                                        }
                                        else{
                                            $('#subcategory').prop('disabled', true);
                                        }
                                        $('#subcategory').find('option').remove().end();
                                        $.each(data, function(i, item){
                                            option = $('<option>', {value: item.id}).html(item.name);
                                            $("#subcategory").append(option);
                                        });
                                    }, 'json');
                                }
                                else{
                                    $('#subcategory').prop('disabled', true);
                                }
                            })
                        </script>

                        @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary" type="button" onclick="window.location='{{ url("/category/create") }}'">Create New</button>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('subcategory') ? ' has-error' : '' }}">
                    <label for="subcategory" class="col-md-3 control-label">Transaction SubCategory</label>

                    <div class="col-md-6">
                        <select id="subcategory" class="form-control" name="subcategory" required disabled>
                            <option>Select a Category</option>
                        </select>

                        @if ($errors->has('subcategory'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subcategory') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary" type="button" onclick="window.location='{{ url("/subcategory/create") }}'">Create New</button>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    <label for="date" class="col-md-3 control-label">Transaction Date</label>

                    <div class="col-md-6">
                        <input id="date" type="date" class="form-control" name="date" required>{{ old('date') }}</input>

                        @if ($errors->has('date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    <label for="notes" class="col-md-3 control-label">Transaction Notes</label>

                    <div class="col-md-6">
                        <textarea id="notes" type="textarea" class="form-control" name="notes" required>{{ old('notes') }}</textarea>

                        @if ($errors->has('notes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('notes') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" id="{{$id}}_cancelBtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" id="{{$id}}_processBtn" class="btn btn-primary">Add Transaction</button>
            <script>
                $("#{{$id}}_processBtn").on('click', function(){
                    $.post('{{url("/post/transaction")}}', $("#{{$id}}_form").serialize(), function(response){
                            if(response == "true"){
                                alert("Transaction(s) was/were uploaded");
                            }
                            else{
                                alert("There was an error uploading your transaction(s).");
                            }
                    });
                });
            </script>
        </div>
        </div>
    </div>
</div>