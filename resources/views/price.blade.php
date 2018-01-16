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
                <div id="blog" class="row">



                    @foreach ($destinations as $destination)
                        <div class="col-md-10 col-lg-offset-1 blogShort">
                     <h1>{{ $destination->name }}</h1>
                     <img src="{{  asset('storage/'.ltrim($destination->image, 'public')) }}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail" height="150" width="150">

                         <em>Owned By: <a href="{{ $destination->user->business->website ?  $destination->user->business->website: '#'}}">{{ $destination->user->business->name }}</a></em>
                     <article><p class="description">
                         {{ substr($destination->description, 0, 250) }}...

                         </p></article>
                     <a class="btn btn-blog pull-right marginBottom10" href="{{ url('destination/'.$destination->id)}}">READ MORE</a>
                 </div>
                    @endforeach

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
