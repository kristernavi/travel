@extends('includes.app')

@section('content') <!-- banner-text -->
</div>
    <!-- //banner -->
    <!-- welcome -->
    <style type="text/css">
        .blogShort{ border-bottom:1px solid #ddd;}
.add{background: #333; padding: 10%; height: 300px;}

.nav-sidebar {
    width: 100%;
    padding: 8px 0;
    border-right: 1px solid #ddd;
}
.nav-sidebar a {
    color: #333;
    -webkit-transition: all 0.08s linear;
    -moz-transition: all 0.08s linear;
    -o-transition: all 0.08s linear;
    transition: all 0.08s linear;
}
.nav-sidebar .active a {
    cursor: default;
    background-color: #34ca78;
    color: #fff;
}
.nav-sidebar .active a:hover {
    background-color: #37D980;
}
.nav-sidebar .text-overflow a,
.nav-sidebar .text-overflow .media-body {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
}
.description{
    overflow:hidden;
    text-overflow:ellipsis;
}

.twitter-typeahead{
        width: 100%;
    }
    .tt-menu{
        width: 100%;
    }

.btn-blog {
    color: #ffffff;
    background-color: #37d980;
    border-color: #37d980;
    border-radius:0;
    margin-bottom:10px
}
.btn-blog:hover,
.btn-blog:focus,
.btn-blog:active,
.btn-blog.active,
.open .dropdown-toggle.btn-blog {
    color: white;
    background-color:#34ca78;
    border-color: #34ca78;
}
 h2{color:#34ca78;}
 .margin10{margin-bottom:10px; margin-right:10px;}
    </style>
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
                <div id="blog" class="row">

                    @forelse ($details as $detail)
                    @php
                    $package = $detail->master;
                    @endphp
                        <div class="col-md-10 col-lg-offset-1 blogShort">
                     <h1>{{ $package->name }}</h1>
                     <img src="{{  asset('storage/'.ltrim($detail->destination->image, 'public')) }}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail" height="150" width="150">

                         <em>Owned By: <a href="{{ $package->user->business ?  $package->user->business->website: '#'}}">{{ $package->user->business ? $package->user->business->name: 'Admin'}}</a></em>
                     <article><p class="description">
                         {{ substr($package->description, 0, 250) }}...

                         </p></article>
                     <a class="btn btn-blog pull-right marginBottom10" href="{{ url('package/'.$package->id)}}">READ MORE</a>
                 </div>


                     @empty
                        <div>No result</div>
                    @endforelse

               <div class="col-md-12 gap10"></div>
             </div>
</div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //welcome -->
    <!-- //newsletter -->
@endsection


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins  and Typeahead) -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- Typeahead.js Bundle -->
    <script src="{{ asset('js/typeahead.bundle.min.js')}}"></script>

    <!-- Typeahead Initialization -->
    <script>
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
