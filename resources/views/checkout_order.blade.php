@extends('includes.app')

@section('content') <!-- banner-text -->
</div>
    <!-- //banner -->
    <!-- welcome -->

    @if(!Cart::isEmpty())
    <div class="albums">
        <div class="w3lalbums-grid">
            <div class="col-md-12 albums-right padding-0" style="background: #f6f7fb;padding-top: 2em; padding-bottom: 1em; ">
                <div class="container">
                    <h4>Customize Package</h4>
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
@if(session('success'))
  <div class="alert alert-success">
       <strong> {{ session('success')}} </strong> <br>
    </div>
@endif


                <form method="POST" action="{{ url('checkout-order/')}}">
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
    <label ">Address 2</label>
    <input type="date" class="form-control"  placeholder="e.g 000011"  value="{{ old('date')}}" name="date" min="{{ date('Y-m-d',strtotime("+1 days"))}}">
  </div>
 <div class="col-md-12">
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
      <legend>Order Detail</legend>
        <table class="table">
    <thead>
      <tr>
        <th>Destination</th>
        <th>Price</th>
        <th>Action</th>


      </tr>
    </thead>
    <tbody>


      @foreach (Cart::getContent() as $item)
      <tr>
        <td>{{ $item->name }}</td>
        <td>{{ number_format($item->price,2) }}</td>
        <td><a href="remove-cart/{{$item->id}}" class="btn btn-danger " role="button">Remove</a></td>
      </tr>

      @endforeach
      <tr>
        <td> <strong>Total</strong></td>
        <td> <strong>{{ number_format(Cart::getTotal(),2) }} </strong></td>

      </tr>

    </tbody>
  </table>

    </fieldset>
 </div>

 <div class="form-group col-md-6 pull-right">
    <input type="submit" class="btn btn-info" value="Submit Button">
  </div>
</form>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @else
      <div class="container" style="padding: 20px">
                    <h4>Empty Cart</h4>
                </div>
    @endif
    <!-- //welcome -->
    <!-- //newsletter -->
@endsection
