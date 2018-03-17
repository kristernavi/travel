@extends('includes.app')

@section('content') <!-- banner-text -->
<style type="text/css">
  p {
    color: #333 !important;
  }
</style>
</div>
    <!-- //banner -->
    <!-- welcome -->


@if(session('success'))

 <div class="container" style="padding: 20px">
  @php
          $book = session('book');
  @endphp
  @if($book->booked)
        <div class="alert alert-success">
        <strong> {{ session('success')}} </strong> <br>
        </div>
  @else
  <div class="albums">
        <div class="w3lalbums-grid">
            <div class="col-md-12 albums-right padding-0" style="background: #f6f7fb;padding-top: 2em; padding-bottom: 1em; ">
                <div class="container">
                    <h4>How to pay in {{ session('payment')}}</h4>
                    <p style="text-align: justify;">
                      <strong>Your Book #: {{sprintf("%05d", $book->id) }}
                        </strong>
                    </p>
                    <br/>
                            <ol style="text-align:justify; color: #333 !important;">



<li>
<p>
            <b>Go to the nearest {{ session('payment')}}</b>
        </p>
<p>
            Fill up the neccesary information that given by the form in sender area
        </p>
            <p>
            Send with the amount of <strong>Pesos {{ number_format(session('amount'),2)}}</strong>
        </p>
</li>
<li>
<p>
            <b>Reciever Information</b>
        </p>
<p>
            The reciever information must our information given below and it must in correct spelling.
            <div style="padding: 5px">
              <p>* Name: <strong>John Doe </strong></p>

              <p>* Mobile Number:<strong> 090912312312 </strong></p>

              <p>* Location: <strong>Balilihan Bohol</strong> </p>

            </div>
        </p>
</li>

<li>
<p>
            <b>After Paying in {{ session('payment')}}</b>
        </p>
<p>
           <p>Contact Us via the follwing:</p>
           <p>Email: bisubohol.travel@gmail.com</p>
           <p>Mobile: 090912312312</p>
         <p>Our in offical <a href="https://www.facebook.com/">facebook page</a>
        </p>
</li>

<li>
<p>
            <b>On this format</b>
        </p>
<p>
           <p>Sender Name: EX. Jane Doe</p>
           <p>Transaction ID: EX. (ANC-XX0-1DSS-1SS)</p>
           <p>Book #: EX. ({{sprintf("%05d", $book->id) }})</p>
           <p>Amount : EX. (Pesos {{ number_format(session('amount'),2) }})</p>
           <p>Via: {{ session('payment')}}</p>

</li>
<li>
<p>
            <b>And will contact you as soon as the book is confirm</b>
        </p>
<p>


</li>




</ol>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
  @endif
 </div>



@else
    <div class="albums">
        <div class="w3lalbums-grid">
            <div class="col-md-12 albums-right padding-0" style="background: #f6f7fb;padding-top: 2em; padding-bottom: 1em; ">
                <div class="container">
                    <h4>Book to {{ $package->name}}</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="welcome">
        <div class="container">
            <div class="welcome-grids">
              @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif



                <form method="POST" action="{{ url('new-book/'.$package->id)}}">
                  {{ csrf_field()}}
  <div class="form-group col-md-6">
    <label >Your Name</label>
    <input type="text" class="form-control"  placeholder="e.g John Doe" value="{{ old('name')}}" name="name">
  </div>
  <div class="form-group col-md-6">
    <label>Email</label>
    <input type="email" class="form-control" aria-describedby="emailHelp"  placeholder="e.g mybusiness@example.com"  value="{{ old('email')}}" name="email">
  </div>
  <div class="form-group col-md-6">
    <label >Mobile Number</label>
    <input type="text" class="form-control"   placeholder="09991923121"  value="{{ old('mobile')}}" name="mobile">
  </div>
  <div class="form-group col-md-6">
    <label ">Phone Number</label>
    <input type="text" class="form-control"  placeholder="322-231-231"  value="{{ old('phone')}}" name="phone">
  </div>

  <div class="form-group col-md-6">
     <label for="sel1">Address</label>

     <input type="text" class="form-control"  placeholder="e.g 000011"  value="{{ old('address')}}" name="address">
  </div>
  <div class="form-group col-md-6">
    <label ">Address 2</label>
    <input type="text" class="form-control"  placeholder="e.g 000011"  value="{{ old('address2')}}" name="address2">
  </div>
 <div class="form-group col-md-6">
    <label ">Reservation Date</label>
    <input type="date" class="form-control"  placeholder="e.g 000011"  value="{{ old('date')}}" name="date" min="{{ date('Y-m-d')}}">
  </div>
<div class="form-group col-md-6">
    <label ">Payment Option</label>
    <select class="form-control" id="payment-option" name="type">
        <option value="card">Credit / Debit Card</option>
        <option value="Bayad Center">Bayad Center</option>
        <option value="Palawan">Palawan</option>
        <option value="Mhuiler">Mhuiler</option>
    </select>

  </div>
   <div class="form-group col-md-6">
    <label ">Additional Person / Fee &#8369;{{ number_format($package->additional_rate,2) }}</label>
    <input type="number" class="form-control"  placeholder="0" min="0" max="20" value="0" name="additional" id="additional">
  </div>
 <div class="col-md-12" id="card-area">
    <fieldset>
      <legend>Payment</legend>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="holder" id="card-holder-name" placeholder="Card Holder's Name" value=" {{ old('holder')}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-number">Card Number</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="number" id="card-number" placeholder="Debit/Credit Card Number" value=" {{ old('number')}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-3">
              {{ Form::selectMonth('month', old('month'), ['class' => 'form-control col-sm-2']) }}

            </div>
            <div class="col-xs-3">
              {{ Form::selectYear('year', date('Y'), date('Y') + 10, old('year'), ['class' => 'form-control']) }}

            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
        </div>
      </div>

    </fieldset>
 </div>

 <div class="col-md-12">
    <fieldset>
      <legend>Package Detail</legend>
        <table class="table">
    <thead>
      <tr>
        <th>Service</th>
        <th>Destination</th>
        <th>Price</th>

      </tr>
    </thead>
    <tbody>
      @php
      $details = $package->details;
      @endphp

      @foreach ($details as $detail)
      <tr>
        <td>{{ $detail->destination->name }}</td>
        <td>{{ $detail->destination->municipality->name }}</td>

        <td>{{ number_format($detail->price,2) }}</td>

      </tr>

      @endforeach
      <tr>
        <td> <strong>Total</strong></td>
        <td>  </td>
        <td> <strong id="current_price">{{ number_format($details->sum('price'),2) }} </strong></td>

      </tr>

    </tbody>
  </table>

    </fieldset>
 </div>

 <div class="form-group col-md-6 pull-right">
     <div class="row">
      <div class="checkbox">
    <label><input type="checkbox" required> I agree on the <a href="/terms">Terms and Conditions</a></label>
    </div>
    </div>
    <input type="submit" class="btn btn-info" value="Submit Button">
  </div>
</form>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @endif
    <!-- //welcome -->
    <!-- //newsletter -->
     <script type="text/javascript">
      $('#payment-option').on('change', function() {

        if( $(this).find(":checked").val() != 'card'){
          $('#card-area').addClass('hidden');

        }
        else{
          $('#card-area').removeClass('hidden');
        }
    });
      $('#additional').on('change', function() {
        let price = {{ $package->details->sum('price') }};
        price = parseFloat(price) + ($('#additional').val() * {{ $package->additional_rate}});
        $('#current_price').html(price.toFixed(2));
    });
    </script>
@endsection
