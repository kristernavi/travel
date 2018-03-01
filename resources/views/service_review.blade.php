<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header bg-green lt">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Leave Your Review Here</h4>
    </div>
    {{ Form::open(array('method' => 'POST', 'id' => 'add-review-form')) }}



    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
            <table class="cart-table table">
                <tr>
                    <td class="item-name-col">
                        <figure>
                            <a href="#"><img src="{{  asset('storage/'.ltrim($service->image, 'public')) }}" alt="{{ $service->name }}" height="20%" width="40%"></a>
                        </figure>
                        <header class="item-name"><a href="#">{{ $service->name }}</a></header>
                        <ul>
                            {{-- <li>Price: {{ number_format($product->price,2) }}</li>
                            <li><span>Brand:</span>{{$product->brand->name}}</li> --}}
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
          <div class="  col-lg-12">
                <label style="
    margin-top: 30px;
    float: left;
    margin-left: 5px;
    margin-bottom: -10px;">Rating:</label>
            </div>
            <div class="col-md-12">
              <div class="stars">
                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                <label class="star star-1" for="star-1"></label>

            </div>
          </div>




        </div>



    </div>
    <div class="modal-footer ">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        {{ Form::submit('Submit', ['class' => 'btn submit-btn btn-success btn-gradient pull-right']) }}
      {{ Form::close() }}
    </div>

  </div>
</div>

<link rel="stylesheet" type="text/css" href="css/stars.css">
 <!-- Laravel Javascript Validation -->

<script type="text/javascript">
  $(function(){

      $("#add-review-form").on('submit', function(e){
          e.preventDefault();
          var that = this;
       //   if($("#add-review-form").valid()){
            $(".submit-btn").addClass("disabled");
            $('button[type=submit], input[type=submit]').prop('disabled',true);
            $.ajax({
                type: 'POST',
                url: 'review-service/'+'{{ $service->id }}',
                data: $('#add-review-form').serialize(),
                dataType: 'json',
                success: function(data){

                }
            }).done(function(data) {
              location.reload();
            }).error(function(data) {


            });
       //   }
        });
  });
 </script>
