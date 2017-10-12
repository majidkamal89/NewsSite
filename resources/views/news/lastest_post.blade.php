<div class="col-md-4">
    @if(\Auth::user())
        @if(\Auth::user()->is_verified == 1)
            <a href="{{route('createNews')}}" class="btn btn-small btn-primary">Create News</a>
        @else
            <a href="javascript:;" class="btn btn-small btn-primary confirm-email">Create News</a>
        @endif
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Popular Posts</strong>
        </div>
        @if(count($latestPosts) > 0)
            @foreach($latestPosts as $post)
                <div class="panel-body">
                    <div class="media">
                        <a class="media-left" href="{{route('newsDetail', $post->id)}}">
                            <img src="{{ url('/').'/uploads/news/thumb/'.$post->image }}" alt="">
                        </a>

                        <div class="media-body">
                            <h4 class="media-heading">{!! $post->name !!}</h4>

                            <p>{{ substr($post->description, 0, 150) }}</p>

                            <div class="ficon">
                                <a href="{{route('newsDetail', $post->id)}}">Read more</a> <i
                                        class="fa fa-long-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="panel-body">
                <div class="media">
                    No Record Found
                </div>
            </div>
        @endif
    </div>
</div>