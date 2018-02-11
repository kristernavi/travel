@extends('includes.app')

@section('content') <!-- banner-text -->
        <div class="banner-text">
            <div class="container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="banner-w3lstext">
                                <h2>VISIT BOHOL PROVINCE</h2>
                                <p>Lose yourself amidst the bizarre Chocolate Hills. Fall in love with the cuddly Tarsiers and make friends with smiling locals. Bohol has everything for the perfect gateway.

                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="banner-w3lstext">
                                <h3>WHY BOHOL ?</h3>
                                <p>Bohol is a small piece of the loss paradise with full of wonders and captivating sites. It is not just known locally but as well as globally. Truly, an ideal place for everyone because of its terrific tranquil ambiance.</p>
                            </div>
                        </li>
                        <li>
                            <div class="banner-w3lstext">
                                <h3>FALLING IN LOVE WITH A WONDERLAND CALLED - - -BOHOL </h3>
                                <p>People come here for the white beaches and beautiful nature with its diverse wildlife. The world class diving, waterfalls and hundreds of caves for spelunking. People come for the incredible history along with its colonial Spanish churches. </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //banner-text -->
</div>
    <!-- //banner -->
    <!-- welcome -->
    <div class="welcome">
        <div class="container">
           {{--  <div class="welcome-grids">
                <div class="col-md-7 welcome-w3left">
                    <h4>TOURIST DESTINATIONS</h4>
                    <p></p> <br>

                </div>
                <div class="col-md-5 welcome-w3right">
                    <img src="{{ asset('web/images/y.jpg') }}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>
            </div> --}}
        </div>
    </div>
    <!-- //welcome -->
    <!--- albums -->
    <div class="albums">
        @foreach ($details as $index => $detail)

        @if ($index % 2 == 0)
         <div class="w3lalbums-grid">
            <div class="col-md-6 col-sm-6 albums-left">
                <div class="col-md-5 welcome-w3right">
                    <img src="{{  asset('storage/'.ltrim($detail->destination->image, 'public')) }}" class="img-responsive" alt="" style="min-height: 402px; min-width: 616px" />
                </div>
            </div>
            <div class="col-md-6 col-sm-6 albums-right">
                <a href="{{ url('package/'.$detail->master->id) }}"><h4 style="color: #f30d60">{{ $detail->destination->name }}</h4></a>
                {!! $detail->destination->description !!}
            </div>
            <div class="clearfix"></div>
        </div>
        @else
        <div class="w3lalbums-grid">
            <div class="col-md-6 col-sm-6 albums1-right">
                <img src="{{  asset('storage/'.ltrim($detail->destination->image, 'public')) }}" class="img-responsive" alt="" style="min-height: 402px; min-width: 616px" />
            </div>
            <div class="col-md-6 col-sm-6 albums1-left">
                <a href="{{ url('package/'.$detail->master->id) }}"><h4 style="color: #f30d60">{{ $detail->destination->name }}</h4></a>
                {!! $detail->destination->description !!}
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        @endif

        @endforeach


    </div>
    <!--- //albums -->
    <!-- services -->
    <div class="services">
        <div class="container">
            <h3 class="agileits-title">Our Services</h3>
            <div class="services-w3ls-row">
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-gears icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission"></h4>
                        <p class="description"> </p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-group icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission"> </h4>
                        <p class="description"></p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-briefcase icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission"></h4>
                        <p class="description"></p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-list-alt icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission"></h4>
                        <p class="description"></p>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //services -->
    <!-- slid -->
    <div class="slid">
        <div class="container">
            <h4>Today Special</h4>
            <p></p>
        </div>
    </div>
    <!-- //slid -->
    <!-- newsletter -->
{{--     <div class="newsletter">
        <div class="container">
            <h3 class="agileits-title">Newsletter</h3>
            <p>Mauris est odio laoreet laoreet sapien non, sollicitudin bibendum nulla amet purus sodales blandit.</p>
            <form action="#" method="post">
                <input type="text" name="email" placeholder="Enter your Email..." required="">
                <input type="submit" value="Subscribe">
                <div class="clearfix"> </div>
            </form>
        </div>
    </div> --}}
    <!-- //newsletter -->
@endsection
