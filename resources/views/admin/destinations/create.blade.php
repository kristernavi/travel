<div class="modal-dialog modal-lg add-user-form">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Add Destination</h4>
    </div>


    {!! Form::open(array('url' => url('admin/destinations'), 'enctype' => 'multipart/form-data', 'method' => 'POST', 'id' => 'add-destinations-form', 'files' => true)) !!}
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false">
          <span class="help-text text-danger"></span>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Description"></textarea>
          <span class="help-text text-danger"></span>
        </div>

        <div class="form-group">
            <label for="name">Image</label>
            <div class="col-md-12 text-center">
                <img src="{{ url('images/img_holder.png') }}" align="img" style=" height: 150px; display: inline-block; float: none;box-shadow: 0px 0px 0px 2px #eee;background: #fff;" id="prev_img2">
            </div>
            <div class="col-md-12 text-center  mb-1">
                    <input type="file" name="image" id="image" class="image input_image" style="display: none;">
                <label class="mt-1" >
                    <div class="btn btn-success upload_btn">Upload Photo</div>
                </label>
          <span class="help-text text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="link">Destination Website Link</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Enter link" autocomplete="false">
          <span class="help-text text-danger"></span>
        </div>
        <div class="form-group">
            <label for="long">Municipality: </label>
             {{ Form::select('municipality_id', \App\Municipality::pluck('name','id'), null, ['class' => 'form-control']) }}
          <span class="help-text text-danger"></span>
        </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit('Submit', ['class' => 'btn submit-btn btn-primary btn-gradient pull-right']) !!}
      {!! Form::close() !!}
    </div>

  </div>
</div>


<script type="text/javascript">
  $(function(){

    $(document).off('click', '.upload_btn').on('click', '.upload_btn', function(){
        $('.input_image').click();
    });

    $(document).off('change',  '#image').on('change',  '#image', function(evt){
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('prev_img2').src = fr.result;
                $('.upload_btn').html('Change Photo');
            }
            fr.readAsDataURL(files[0]);
        }
        else {
        }
    });
      $("#add-destinations-form").on('submit', function(e){
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var $form = $(this);
        var $url = $form.attr('action');
        var formData = new FormData($("form#add-destinations-form")[0]);
        //submit a POST request with the form data
        //submits an array of key-value pairs to the form's action URL
     /*   $.post(url, formData, function(response)
        {
            //handle successful validation
            alert(1);
        }).fail(function(response)
        {
            //handle failed validation
            alert(1);
            associate_errors(response['errors'], $form);
        });*/

        $.ajax({
          type: 'POST',
          url: $url,
          data: formData,
          processData: false,
          contentType: false,
          success: function(result){
            if(result.success){
              swal({
                  title: result.msg,
                  icon: "success"
                });
            }else{
              swal({
                  title: result.msg,
                  icon: "error"
                });
            }
            $("#destinations-table").DataTable().ajax.url( '/admin/get-destinations' ).load();
            $('.modal').modal('hide');
          },
          error: function(xhr,status,error){
            var response_object = JSON.parse(xhr.responseText);
            associate_errors(response_object.errors, $form);
          }
        });

      });
  });
 </script>
