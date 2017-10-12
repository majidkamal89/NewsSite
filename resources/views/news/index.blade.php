@extends('layouts.app')

@section('content')
<br/>
<style>
    .page-header {
        margin: 1px 0 !important;
    }
</style>

@if (Session::has('error'))
    <div class="container" id="notification_div">
        <div class="row">
            <div class="col-md-4" style="float: none; margin: 0 auto;">
                <div class="alert alert-error text-center">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(count($newsData) > 0)
                @foreach($newsData as $news)
                    <div class="page-header">
                        <div class="blog">
                            <h5>{!! date('F d, Y h:i:s', strtotime($news->created_at)) !!}</h5>
                            <img src="{{ url('/').'/uploads/news/'.$news->image }}" class="img-responsive" alt="Image not found" />
                            <h3>{!! $news->title !!}</h3>
                            <p>{!! $news->description !!}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="page-header">
                    <div class="blog">
                        <h5>No Record Found.</h5>
                    </div>
                </div>
            @endif
        </div>

        @include('news.lastest_post')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="verification_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: black;">Email not Verified</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Please first verify your email to publish new Article.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="margin: 0px;" data-dismiss="modal">OK</button>
                </div>
            </div>

        </div>
    </div>
    <!-- End Modal -->
</div>

<div class="container">
    <nav>
        {!! $newsData->render() !!}
    </nav>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.confirm-email', function(){
            $("#verification_modal").modal('show');
        });
    </script>
@endsection