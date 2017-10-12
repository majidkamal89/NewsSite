@extends('layouts.app')

@section('style')
    .align-center {
    padding:0px !important;
    }
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="recent">
                <button class="btn-primarys"><h3>Latest News</h3></button>
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="popup-gallery">
                @if(count($latestPosts) > 0)
                    @foreach($latestPosts as $post)
                        <div class="col-md-3">
                            <div class="wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
                                <div class="align-center">
                                    <h4>{!! $post->title !!}</h4>
                                    <div class="icon">
                                        <h5>{{ date('F d, Y', strtotime($post->created_at)) }}</h5>
                                        <a href="{{route('newsDetail', $post->id)}}" title="{!! $post->title !!}">
                                            <img src="{{ url('/').'/uploads/news/'.$post->image }}" class="img-responsive" alt="No Image" />
                                        </a>
                                    </div>
                                    <p>{!! substr($post->description, 0, 200).'...' !!}</p>
                                    <div class="ficon">
                                        <a href="{{route('newsDetail', $post->id)}}" alt="">Read more</a> <i class="fa fa-long-arrow-right"></i>
                                    </div>
                                    <a class="btn btn-small btn-danger btn-xs" href="{{ route('newsStandPdf', $post->id) }}" style="text-transform: capitalize; margin-top: 5px; margin-right: 5px; float: right;">PDF</a>
                                    <span style="text-transform: capitalize; margin-top: 5px; margin-right: 5px; float: left;">
                                        Author: {!! $post->name !!}
                                    </span>
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