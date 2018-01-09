@extends('includes.app')

@section('content') <!-- banner-text -->
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
                    <h4>CHOCOLATE HILLS</h4>
                    <p>The greatest pride of Bohol. Basically, its a strange group of cuddly shaped hills, a lot of hills. There are more than 1000. Its not easy to describe the place; its like a piece of art.</p> <br>
                    <p>An unbelievable scenery. They look extremely surreal. They are natural wonder!<p>
                
                </div>
                <div class="col-md-5 welcome-w3right">
                    <img src="{{ asset('web/images/m.jpg') }}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //welcome -->
    <!-- //newsletter -->
@endsection