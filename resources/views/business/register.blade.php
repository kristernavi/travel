@extends('includes.app')

@section('content') <!-- banner-text -->
</div>
    <!-- //banner -->
    <!-- welcome -->
    <div class="albums">
        <div class="w3lalbums-grid">
            <div class="col-md-12 albums-right padding-0" style="background: #f6f7fb;padding-top: 2em; padding-bottom: 1em; ">
                <div class="container">
                    <h4>Business Register</h4>
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
 @if (session('activate_message'))
     <div class="alert alert-warning">
       <strong> {{ session('activate_message')}} </strong> <br>
    </div>
    @endif

@if(session('success'))
  <div class="alert alert-warning">
       <strong> {{ session('success')}} </strong> <br>
    </div>
@endif
                <form method="POST" action="{{ url('business/signup')}}">
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
    <label >Business Name</label>
    <input type="text" class="form-control"   placeholder="Hotel De' Example"  value="{{ old('business')}}" name="business">
  </div>
  <div class="form-group col-md-6">
    <label ">Where You Base?</label>
    <input type="text" class="form-control"  placeholder="e.g Panglao Bohol"  value="{{ old('base')}}" name="base">
  </div>

  <div class="form-group col-md-6">
     <label for="sel1">Type:</label>

     {{ Form::select('type', array('hotel' => 'Hotel', 'tourist' => 'Tourist'),old('type'), ['class' => 'form-control'] ) }}
  </div>
  <div class="form-group col-md-6">
    <label ">Business License</label>
    <input type="text" class="form-control"  placeholder="e.g 000011"  value="{{ old('license')}}" name="license">
  </div>

  <div class="form-group col-md-6">
    <label >Do you have website?</label>
    <input type="text" class="form-control"   placeholder="e.g https://www.myhotel.com.ph"  value="{{ old('website')}}" name="website">
  </div>
  <div class="form-group col-md-6">
    <label ">Your Address</label>
    <input type="text" class="form-control"  placeholder="e.g 000011"  value="{{ old('address')}}" name="address">
  </div>

  <div class="form-group col-md-6">
    <label >Mobile Number</label>
    <input type="text" class="form-control"   placeholder="e.g 09123456789"  value="{{ old('mobile')}}" name="mobile">
  </div>
  <div class="form-group col-md-6">
    <label ">Phone Number</label>
    <input type="text" class="form-control"  placeholder="e.g 302-321-312"  value="{{ old('phone')}}" name="phone">
  </div>



  <div class="form-group col-md-6">
    <label >Password</label>
    <input type="password" class="form-control"   placeholder="Password"  value="{{ old('password')}}" name="password">
  </div>
  <div class="form-group col-md-6">
    <label ">Confirm Password</label>
    <input type="password" class="form-control"  placeholder="Password"  value="{{ old('password_confirmation')}}" name="password_confirmation">
  </div>

 <div class="form-group col-md-6 pull-right">
    <input type="submit" class="btn btn-info" value="Submit Button">
  </div>
</form>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //welcome -->
    <!-- //newsletter -->
@endsection
