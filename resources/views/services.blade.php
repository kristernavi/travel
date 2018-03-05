@extends('includes.app')

@section('content') <!-- banner-text -->
</div>
    <!-- //banner -->
    <!-- welcome -->
    <style type="text/css">
    html {
    font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
    font-size: 14px;
}

h5 {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
    margin: 0;
}

.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}
.description {
    white-space: nowrap;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
}
.twitter-typeahead{
        width: 100%;
    }
    .tt-menu{
        width: 100%;
    }
    </style>
    <div class="row" style="padding: 10px">
         <div class="container">
            <div class="welcome-grids">
                <div class="container">
                    <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container">
                <form>
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control"  placeholder="Search Destinations" name="keyword" id="name">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                </form>
            </div>
        </div>
    </div>


<div class="row" style="padding: 5px">
    @if($servicesTourist->count() > 0)
    <div class="row">


    <div class="clear-fix"></div>
    <div style="padding: 5px">
        <h2>Tourist Destinations</h2>
    </div>
    <div class="clear-fix"></div>
    <hr size="30" style="border-top: 1px solid #333;">
    </div>
    @endif
    @foreach ($servicesTourist as $index => $service)

        @if($index % 4 == 0)
        <div class="row"></div>
        @endif

        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="{{  asset('storage/'.ltrim($service->image, 'public')) }}" height="100px">
                    <div class="card-block">
                        <h4 class="card-title">{{ $service->name}}</h4>
                        <div class="meta">
                            <a href="#">{{ optional($service->municipality)->name}}</a>
                        </div>
                        <div class="card-text description">
                            {!! $service->description !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>PHP {{ number_format($service->price,2)}}</strong>
                    </div>
                    <div class="card-footer">
                        <strong>No. of Persons {{ $service->persons }}</strong>
                    </div>
                    <div class="card-footer">
                        <strong>Own by: {{ optional($service->user->business)->name }}</strong>
                    </div>
                    @php
                    $stars = intval($service->avgRating);
                    $unstars = 5 - $stars;
                    @endphp
                    <div class="card-footer">
                        <em><div class="rating">
                            @for ($i = 0; $i < $stars; $i++)
                                <span class="glyphicon glyphicon-star" style="color: #fde16d"></span>
                            @endfor
                            @for ($i = 0; $i < $unstars; $i++)
                                <span class="glyphicon glyphicon-star-empty" ></span>
                            @endfor
                             Reviews: {{ $service->countPositive }}
                        </div>

                    </em>


                        <br/>
                        <button class="btn btn-primary float-right btn-sm add-cart" data-id="{{$service->id}}"> Add Cart</button>
                        <button class="btn btn-primary float-right btn-sm rate-this " data-id="{{$service->id}}">Add Review</button>
                    </div>
                </div>
            </div>
    @endforeach

        </div>

    <!-- //welcome -->
    <!-- //newsletter -->
    <form id="cart-form">

        <input type="hidden" name="service_id" id="service">
        {{ csrf_field() }}
    </form>
    @if($servicesHotel->count() > 0)
    <div class="row" style="padding: 5px">

    <div class="row">

 <hr size="30" style="border-top: 1px solid #333;">
    <div class="clear-fix"></div>
    <div style="padding: 5px">
        <h2>Hotel</h2>
    </div>
    @endif
    <div class="clear-fix"></div>

     @foreach ($servicesHotel as $index => $service)

        @if($index % 4 == 0)
        <div class="row"></div>
        @endif
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="{{  asset('storage/'.ltrim($service->image, 'public')) }}" height="100px">
                    <div class="card-block">
                        <h4 class="card-title">{{ $service->name}}</h4>
                        <div class="meta">
                            <a href="#">{{ optional($service->municipality)->name}}</a>
                        </div>
                        <div class="card-text description">
                            {!! $service->description !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>PHP {{ number_format($service->price,2)}}</strong>
                    </div>
                    <div class="card-footer">
                        <strong>No. of Persons {{ $service->persons }}</strong>
                    </div>
                    <div class="card-footer">
                        <strong>Own by: {{ optional($service->user->business)->name }}</strong>
                    </div>
                    @php
                    $stars = intval($service->avgRating);
                    $unstars = 5 - $stars;
                    @endphp
                    <div class="card-footer">
                        <em><div class="rating">
                            @for ($i = 0; $i < $stars; $i++)
                                <span class="glyphicon glyphicon-star" style="color: #fde16d"></span>
                            @endfor
                            @for ($i = 0; $i < $unstars; $i++)
                                <span class="glyphicon glyphicon-star-empty" ></span>
                            @endfor
                             Reviews: {{ $service->countPositive }}
                        </div>

                    </em>


                        <br/>
                        <button class="btn btn-primary float-right btn-sm add-cart" data-id="{{$service->id}}"> Add Cart</button>
                        <button class="btn btn-primary float-right btn-sm rate-this " data-id="{{$service->id}}">Add Review</button>
                    </div>
                </div>
            </div>
    @endforeach

        </div>
        <div class="row">
            <hr size="30" style="border-top: 1px solid #333;">
    </div>
        </div>

    <!-- //welcome -->
    <!-- //newsletter -->
    <form id="cart-form">

        <input type="hidden" name="service_id" id="service">
        {{ csrf_field() }}
    </form>
<div id="add-review-modal" class="modal fade"></div>

@endsection


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins  and Typeahead) -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- Typeahead.js Bundle -->
    <script src="{{ asset('js/typeahead.bundle.min.js')}}"></script>

    <!-- Typeahead Initialization -->
    <script>

        setTimeout(function(){

               $('#add-review-modal').on('hidden.bs.modal', function () {
            // do something…
             $('.agileinfo-header').removeClass('hidden');

        });

         }, 3000);

        $(document).off('click', '.rate-this').on('click', '.add-cart', function(x){
                var that = this;
                $('#service').val(this.dataset.id);
                 $.ajax({
                    url: 'add-cart',
                    type: 'POST',
                    data: $("#cart-form").serialize(),
                    success: function(data) {
                        window.location.reload();
                    }
                });

            });

        $(document).off('click', '.rate-this').on('click', '.rate-this', function(x){
                var that = this;
                $("#add-review-modal").modal();
                $("#add-review-modal").html("");
                 $('.agileinfo-header').addClass('hidden');
                $.ajax({
                    url: 'review-service/'+that.dataset.id,
                    success: function(data) {
                        $("#add-review-modal").html(data);
                    }
                });
          });


        jQuery(document).ready(function($) {


            var engine_serviceS1= new Bloodhound({
                remote: {
                    url: '/location?name=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('services_name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var tradetp = $("#name").typeahead({
                hint: false,
                highlight: true,
                minLength: 1,


            }, {
                source: engine_serviceS1.ttAdapter(),

                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'tradeList',

                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        //'<div class="list-group search-results-dropdown">'
                        ''
                    ],
                    suggestion: function (data) {
                        return '<div class="list-group-item">' + data.name+'</div>'

                      }

                }
                ,
                display: function(data){
                      return data.name;
                    },


            });

        });




    </script>
