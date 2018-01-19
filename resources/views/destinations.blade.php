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
                    <h4>Destinations</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="welcome">
        <div class="container">
            <div class="welcome-grids">

                <div class="col-md-7 welcome-w3left">
                    <h4>{{ $destination->name}}</h4>
                    {{ $destination->description}}

                </div>
                <div class="col-md-5 welcome-w3right">
                    <img src="{{  asset('storage/'.ltrim($destination->image, 'public')) }}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
    </div>
     <div class="row bg-light navbar-fixed-bottom" id="sticker" >
    <div class="container text-center p-3">
        <strong>Are you interested? </strong>
        <button class="btn btn-success text-dark open-subscribe ml-5 mr-5">
          Book Now
        </button>
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
