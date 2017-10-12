@extends('layouts.app')

@section('content')
<br/>
<style>
    .page-header {
        margin: 1px 0 !important;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach($newsDetail as $news)
                <div class="page-header">
                    <div class="blog">
                        <h5>{!! date('F d, Y', strtotime($news->created_at)) !!} </h5>
                        <img src="{{ url('/').'/uploads/news/'.$news->image }}" class="img-responsive" alt="Image not found" />
                        <h3>{!! $news->title !!}</h3>
                        <p>{!! $news->description !!}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @include('news.lastest_post')
    </div>
</div>

@endsection

@section('script')

@endsection