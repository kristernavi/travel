<div class="modal-dialog modal-lg add-user-form">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Edit</h4>
    </div>
 

    {!! Form::open(array('url' => url('/admin/packages/'.$package->id), 'method' => 'PATCH', 'id' => 'edit-packages-form')) !!}
    <input type="hidden" name="type" value="packages">
    <div class="modal-body">
      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false" value="{{ $package->name }}">
          <span class="help-text text-danger"></span>
      </div> 
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Description">{{ $package->description }}</textarea> 
          <span class="help-text text-danger"></span>
        </div>    
      <div class="select_hoder">
        <label>Destinations</label>
        @foreach($package->details as $detail)

          <div class="row form-group">
            <div class="col-md-5">
              <select class="form-control" name="destination_id[]">
                <option selected disabled>Select Destination</option>
                @foreach($destinations as $destination)
                  <option value="{{ $destination->id }}" {{ $detail->destination_id == $destination->id ? ' selected':'' }}>{{ $destination->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <input type="text" name="price[]" class="form-control text-right" placeholder="0.00" value="{{ $detail->price }}">
            </div>
            <div class="col-md-3">
              <a href="#" class="btn btn-success add-row-btn"><i class="fa fa-plus"></i></a>
              <a href="#" class="btn btn-danger del-row-btn"><i class="fa fa-trash-o"></i></a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row" style="padding-top: 15px;">
        <div class="col-md-5 text-right">
          <label style="padding-top: 5px;">Total Package Price:</label>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control text-right total-price" readonly value="0.00">
        </div>
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
      $("#edit-packages-form").on('submit', function(e){
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var $form = $(this);
        var $url = $form.attr('action'); 

        $.ajax({
          type: 'PATCH',
          url: $url,
          data: $("#edit-packages-form").serialize(), 
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
            $("#packages-table").DataTable().ajax.url( '/admin/get-packages' ).load();
            $('.modal').modal('hide');
            $('.modal').html('');
          },
          error: function(xhr,status,error){
            var response_object = JSON.parse(xhr.responseText); 
            associate_errors(response_object.errors, $form);
          }
        });

      });


  var row_str = '<div class="row form-group">'+
                  '<div class="col-md-5">'+
                    '<select class="form-control" name="destination_id[]">'+
                      '<option selected disabled>Select Destination</option>'+
                      '@foreach($destinations as $destination)'+
                        '<option value="{{ $destination->id }}">{{ $destination->name }}</option>'+
                      '@endforeach'+
                    '</select>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<input type="text" name="price[]" class="form-control text-right" placeholder="0.00">'+
                  '</div>'+
                  '<div class="col-md-3">'+
                    '<a href="#" class="btn btn-success add-row-btn"><i class="fa fa-plus"></i></a> '+
                    '<a href="#" class="btn btn-danger del-row-btn"><i class="fa fa-trash-o"></i></a>'+
                  '</div>'+
                '</div>';
      $(document).off('click', '.add-row-btn').on('click', '.add-row-btn', function(){
        $('.select_hoder').append(row_str);
      });
      $(document).off('click', '.del-row-btn').on('click', '.del-row-btn', function(){
        if($('.select_hoder row').length > 1){
          $(this).parent().parent().remove();
        }
      });
      $(document).on('change', 'input[name="price[]"]', function(){
        var total = 0.00;
        $(this).val(parseFloat($(this).val()).toFixed(2));
        $('input[name="price[]"]').each(function(){
          if(parseFloat($(this).val()) > 0){
            total+=parseFloat($(this).val());
          }
        });
        $('.total-price').val(parseFloat(total).toFixed(2)); 
      });
      $('input[name="price[]"]').change();
  });  
 </script> 