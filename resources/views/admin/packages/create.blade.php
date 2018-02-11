<div class="modal-dialog modal-lg add-user-form">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Add</h4>
    </div>


    {!! Form::open(array('url' => url('/admin/packages'), 'method' => 'POST', 'id' => 'add-packages-form')) !!}
    <input type="hidden" name="type" value="packages">
    <div class="modal-body">
      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false">
          <span class="help-text text-danger"></span>
      </div>
        <div class="form-group">
            <label for="description">Description</label>
           <div id="summernote"></div>
           <input type="hidden" name="description" id="description">
          <span class="help-text text-danger"></span>
        </div>
      <div class="select_hoder">
        <label>Destinations</label>
        <div class="row form-group">
          <div class="col-md-5">
            <select class="form-control" name="destination_id[]">
              <option selected disabled>Select Destination</option>
              @foreach($destinations as $destination)
                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <input type="text" name="price[]" class="form-control text-right create_price" placeholder="0.00">
          </div>
          <div class="col-md-3">
            <a href="#" class="btn btn-success add-row-btn"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-danger del-row-btn"><i class="fa fa-trash-o"></i></a>
          </div>
        </div>
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

<!-- include summernote css/js-->
<link href="{{url('summernote/summernote.css')}}" rel="stylesheet">
<script src="{{url('summernote/summernote.js')}}"></script>

<script type="text/javascript">
$('#summernote').summernote({
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        lang: 'en-US',
        imageAttributes:{
            imageDialogLayout:'default', // default|horizontal
            icon:'<i class="note-icon-pencil"/>',
            removeEmpty:false // true = remove attributes | false = leave empty if present
        },
        displayFields:{
            imageBasic:true,  // show/hide Title, Source, Alt fields
            imageExtra:true, // show/hide Alt, Class, Style, Role fields
            linkBasic:true,   // show/hide URL and Target fields for link
            linkExtra:false   // show/hide Class, Rel, Role fields for link
        },

            height: 150,
            minHeight: null,
            maxHeight: null,
            focus: true,
            toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontname', 'fontsize', 'color', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
              ['para', ['ul', 'ol', 'paragraph', 'style', 'height']],
              ['insert', ['picture', 'link', 'video', 'table', 'hr']],
              ['msic', ['codeview', 'undo', 'redo', 'help']]
            ]
    });
  $(function(){

      $("#add-packages-form").on('submit', function(e){
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var $form = $(this);
        var $url = $form.attr('action');
        var html = $('#summernote').summernote('code');
        $('#description').val(html);
        $.ajax({
          type: 'POST',
          url: $url,
          data: $("#add-packages-form").serialize(),
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
                    '<input type="text" name="price[]" class="form-control text-right create_price" placeholder="0.00">'+
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
      $(document).on('change', '.create_price', function(){
        var total = 0.00;
        $(this).val(parseFloat($(this).val()).toFixed(2));
        $('.create_price').each(function(){
          if(parseFloat($(this).val()) > 0){
            total+=parseFloat($(this).val());
          }
        });
        $('.total-price').val(parseFloat(total).toFixed(2));
      });
  });
 </script>
