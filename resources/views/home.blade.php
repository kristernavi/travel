@extends('includes.app')

@section('content') <!-- banner-text -->
        <div class="banner-text"> 
            <div class="container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="banner-w3lstext">
                                <h2>Enjoy The Beauty Of Nature</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mauris non mi gravida, at sollicitudin odio efficitur. Mauris ex nulla, aliquam ornare facilisis nec convallis pulvinar a non nunc non leo sollicitudin</p>
                            </div>
                        </li>
                        <li>
                            <div class="banner-w3lstext">
                                <h3>Lorem Ipsum Dolor Sit </h3>
                                <p>Integer gravida mauris non mi gravida, at sollicitudin odio efficitur. Lorem ipsum dolor sit amet elit consectetur adipiscing. Mauris ex nulla, aliquam ornare facilisis nec convallis pulvinar a non nunc non leo sollicitudin</p>
                            </div>
                        </li>
                        <li>
                            <div class="banner-w3lstext">
                                <h3>Mauris Ex Nulla Aliquam </h3>
                                <p>Mauris ex nulla, aliquam ornare facilisis nec convallis pulvinar a non nunc non leo sollicitudin, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mauris non mi gravida, at sollicitudin odio efficitur. </p>
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
    <!--- albums -->
    <div class="albums"> 
        <div class="w3lalbums-grid">
            <div class="col-md-6 col-sm-6 albums-left"> 
                <div class="wthree-almubimg">  
                </div>
            </div>
            <div class="col-md-6 col-sm-6 albums-right">
                <h4>Our Latest Trips</h4>
                <p>Duis nulla nulla, faucibus id diam ac, luctus sodales purus. Quisque nibh ipsum, venenatis vitae imperdiet eu, commodo nec sem. Ut accumsan tellus quis velit mattis sollicitudin. Etiam ullamcorper sapien sed purus suscipit, eu congue justo pulvinar. </p>
            </div>
            <div class="clearfix"></div>
        </div> 
        <div class="w3lalbums-grid">
            <div class="col-md-6 col-sm-6 albums1-right"> 
                <div class="wthree-almubimg wthree1-almubimg">  
                </div>
            </div>
            <div class="col-md-6 col-sm-6 albums1-left">
                <h4>Our Latest Trips</h4>
                <p>Duis nulla nulla, faucibus id diam ac, luctus sodales purus. Quisque nibh ipsum, venenatis vitae imperdiet eu, commodo nec sem. Ut accumsan tellus quis velit mattis sollicitudin. Etiam ullamcorper sapien sed purus suscipit, eu congue justo pulvinar. </p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>  
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
                        <h4 class="mission">Fugiat Quo</h4>
                        <p class="description">Sceleris Prae </p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-group icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Voluptas </h4>
                        <p class="description">Scele Praesent</p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-briefcase icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Quo fugiat</h4>
                        <p class="description">Scele Praesent</p>
                    </div>
                </div>  
                <div class="col-xs-6 col-md-3 services-grids">
                    <div class="w3agile-servs-img">
                        <div class="icon-holder">
                            <span class="fa fa-list-alt icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Voluptas</h4>
                        <p class="description">Scele Aesent</p>
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
            <p>In malesuada accumsan felis, a imperdiet arcu blandit sed. Ut id faucibus eros. Fusce sed vulputate dui, non consectetur felis. Etiam id enim sem. Suspendisse commodo tempor magna </p>
        </div> 
    </div>
    <!-- //slid -->
    <!-- newsletter -->
    <div class="newsletter">
        <div class="container">
            <h3 class="agileits-title">Newsletter</h3>
            <p>Mauris est odio laoreet laoreet sapien non, sollicitudin bibendum nulla amet purus sodales blandit.</p>
            <form action="#" method="post"> 
                <input type="text" name="email" placeholder="Enter your Email..." required="">
                <input type="submit" value="Subscribe">
                <div class="clearfix"> </div> 
            </form> 
        </div> 
    </div>
    <!-- //newsletter -->
@endsection