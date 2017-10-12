@extends('layouts.app')

@section('content')
    <!-- Responsive slider - START -->
    @if (Session::has('success'))
        <div class="container" id="notification_div">
            <div class="row">
                <div class="col-md-4" style="float: none; margin: 0 auto;">
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="slider">
        <div class="container">
            <div class="row">
                <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
                    <div class="slides" data-group="slides">
                        <ul>
                            <li>
                                <div class="slide-body" data-group="slide">
                                    <img src="{{ asset('assets/img/2a.jpg') }}" alt="">

                                    <div class="caption header" data-animate="slideAppearUpToDown" data-delay="500"
                                         data-length="300">
                                        <button class="btn btn-primary"><h2> we are creative design</h2></button>
                                        <div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200"
                                             data-length="300">
                                            <button class="btn btn-primary"><h4><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet.</span>
                                                </h4></button>
                                        </div>
                                        <div class="caption-sub" data-animate="slideAppearLeftToRight" data-delay="900"
                                             data-length="300">
                                            <button class="btn btn-primary"><h3>With one to one swipe movement!</h3>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="slide-body" data-group="slide">
                                    <img src="{{ asset('assets/img/1.jpg') }}" alt="">

                                    <div class="caption header" data-animate="slideAppearDownToUp" data-delay="500"
                                         data-length="300">
                                        <button type="button" class="btn btn-primary" data-toggle="button"
                                                aria-pressed="false" autocomplete="off"><h2>creative design Responsive
                                                slider</h2></button>
                                        <div class="caption-sub" data-animate="slideAppearUpToDown" data-delay="800"
                                             data-length="300">
                                            <button class="btn btn-primary"><h4><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet. </span>
                                                </h4></button>
                                        </div>
                                        <div class="caption-sub" data-animate="slideAppearRightToLeft" data-delay="1200"
                                             data-length="300">
                                            <button class="btn btn-primary"><h3>Clean and Flat</h3></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="slide-body" data-group="slide">
                                    <img src="{{ asset('assets/img/10.jpg') }}" alt="">

                                    <div class="caption header" data-animate="slideAppearUpToDown" data-delay="500"
                                         data-length="300">
                                        <button type="button" class="btn btn-primary" data-toggle="button"
                                                aria-pressed="false" autocomplete="off"><h2>creative design Custom
                                                animations</h2></button>
                                        <div class="caption-sub" data-animate="slideAppearLeftToRight" data-delay="800"
                                             data-length="300">
                                            <button class="btn btn-primary"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit sit amet.</h4></button>
                                        </div>
                                        <div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200"
                                             data-length="300">
                                            <button class="btn btn-primary"><h3><span>New style Slides!</span></h3>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <a class="slider-control left" href="#" data-jump="prev"><i class="fa fa-angle-left fa-2x"></i></a>
                    <a class="slider-control right" href="#" data-jump="next"><i
                                class="fa fa-angle-right fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive slider - END -->

    <div class="container">
        <div class="row">
            <div class="recent">
                <button class="btn-primarys"><h3>Latest Posts</h3></button>
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="content">


                @if(count($latestPosts) > 0)
                    @foreach($latestPosts as $post)
                        <div class="col-md-4">
                            <div class="wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
                                <div class="align-center">
                                    <h4>{!! $post->title !!}</h4>
                                    <div class="icon">
                                        <a href="{{route('newsDetail', $post->id)}}" title="{!! $post->title !!}">
                                            <img src="{{ url('/').'/uploads/news/'.$post->image }}" class="img-responsive" alt="No Image" />
                                        </a>
                                    </div>
                                    <p>{!! $post->description !!}</p>
                                    <div class="ficon">
                                        <a href="{{route('newsDetail', $post->id)}}" alt="">Read more</a> <i class="fa fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        No Record Found
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection