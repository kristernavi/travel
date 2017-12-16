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
                    <h4>Temporibus autem quibusdam</h4>
                    <p>Voluptas assumenda est, omnis dolor repellendus. 
                        Temporibus autem quibusdam et aut officiis debitis aut 
                        rerum necessitatibus saepe.Nam libero tempore, cum soluta nobis est eligendi optio cumque 
                        nihil impedit quo minus id quod maxime placeat facere possimus, 
                        omnis voluptas assumenda est, omnis dolor repellendus.</p> <br>
                    <p> Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe  possimus, 
                        omnis voluptas assumenda est.</p> 
                </div>
                <div class="col-md-5 welcome-w3right">
                    <img src="{{ asset('web/images/img1.jpg') }}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //welcome -->
    <!-- //newsletter -->
@endsection