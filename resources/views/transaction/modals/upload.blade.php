<div class="modal fade message-modal" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Upload Transactions (CSV)</h4>
        </div>
        <div class="modal-body">
            
            <form class="form-horizontal" id="{{$id}}_form" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}

                <input type="hidden" name="isFile" value="true">

                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                    <label for="file" class="col-md-3 control-label">CSV File</label>

                    <div class="col-md-6">
                        <input type="file" class="form-control" name="file" id="file">

                        @if ($errors->has('file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" id="{{$id}}_cancelBtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" id="{{$id}}_processBtn" class="btn btn-primary" data-dismiss="modal">Process</button>
            <script>
                $("#{{$id}}_processBtn").on('click', function(){
                    var data = new FormData();
                    var file = $("#file")[0].files[0];
                    data.append('file', file, 'thisfile');
                    data.append('_token', "{{csrf_token()}}")
                    $.ajax({
                        url:'{{url("/post/transaction")}}',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        success: function(response){
                            if(response == "true"){
                                alert("Transactions were uploaded");
                            }
                            else{
                                alert("There was an error uploading your transactions.");
                            }
                        }
                    });
                });
            </script>
        </div>
        </div>
    </div>
</div>