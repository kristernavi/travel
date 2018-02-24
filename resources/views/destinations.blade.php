@extends('includes.app')

@section('content') <!-- banner-text -->

<style type="text/css">
    .bg-light {
    background-color: #C1D5FF !important;
    padding-bottom: 30px;
    padding-top: 30px;

}
</style>
</div>
    <!-- //banner -->
    <!-- welcome -->
    <div class="albums">
        <div class="w3lalbums-grid">
            <div class="col-md-12 albums-right padding-0" style="background: #f6f7fb;padding-top: 2em; padding-bottom: 1em; ">
                <div class="container">
                    <h4>{{ $package->name}}</h4>

                    <h5> Owner:
                      <a href=" {{ url('destinations?owner='.optional($package->user->business)->name)}}">{{ optional($package->user->business)->name}} </a></h5>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    @foreach ($package->details as $index => $detail)

    @if ($index % 2 == 0)
    <div class="welcome">
        <div class="container">
            <div class="welcome-grids">

                <div class="col-md-7 welcome-w3left">
                   <a href="{{ $detail->destination->website }}"> <h4> {{ $detail->destination->name }}</h4> </a>
                    {!! $detail->destination->description !!}

                </div>
                <div class="col-md-5 welcome-w3right">
                    <img src="{{  asset('storage/'.ltrim($detail->destination->image, 'public')) }}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
    </div>
     @else
     <div class="welcome">
        <div class="container">
            <div class="welcome-grids">

                <div class="col-md-5 welcome-w3right">
                   <img src="{{  asset('storage/'.ltrim($detail->destination->image, 'public')) }}" class="img-responsive" alt="" />


                </div>
                <div class="col-md-7 welcome-w3left">
                     <a href="{{ $detail->destination->website }}"> <h4> {{ $detail->destination->name}}</h4> </a>
                    {!!  $detail->destination->description !!}
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
    </div>


     @endif
    @endforeach
<<<<<<< HEAD
    <div class="welcome">
        <div class="container">
            <div class="welcome-grids">

               
                <div class="col-md-12 welcome-w3left">
                     <a href="{{ $detail->destination->website }}"> <h4> Inclusions</h4> </a>

                    {!!  $package->description !!}
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
    </div>

     <div class="row bg-light navbar-fixed-bottom" id="sticker" >
    <div class="container text-center p-3">
        <strong>Are you interested? As low as PHP {{ number_format($package->details->sum('price'),2)}} </strong>
        <a class="btn btn-success text-dark open-subscribe ml-5 mr-5" href="{{ url('new-book/'. $package->id)}}">
          Book Now
        </a>
    </div>
  </div>
    <!-- //welcome -->
    <!-- //newsletter -->
    <script type="text/javascript">

      $(window).scroll(function(){
        var limit = $(document).height() - $(window).height() - $('#footer').height();
          if ($(window).scrollTop() >= limit) {
              $('#sticker').hide();
          }
          else if($(window).scrollTop() > 100){
            $('#sticker').fadeIn();
          }
          else{
            $('#sticker').hide();
          }
      });


    </script>
@endsection
