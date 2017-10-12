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
                <button class="btn-primarys"><h3>My Posts</h3></button>
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="popup-gallery">
                @if(count($allPosts) > 0)
                    @foreach($allPosts as $post)
                        <div class="col-md-3">
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
                                    <span class="btn btn-small btn-danger btn-xs deleteBtn" data-link="{{ route('deletePost', $post->id) }}" style="text-transform: capitalize; margin-top: 5px; margin-right: 5px; float: right;">Delete Article</span>
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

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: black;">Delete Article</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete this Article?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" style="margin: 0px;" data-dismiss="modal">Close</button>
                        <a href="javascript:;" class="btn btn-danger confirm-delete">Confirm</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Modal -->

    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.deleteBtn', function(){
            var url = $(this).attr('data-link');
            $('.confirm-delete').attr('href', url);
            $("#deleteModal").modal('show');
        });
    </script>
@endsection