@extends('layouts.app')

@section('content')
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
    <div class="container">
        <div class="row">
            <div class="recent">
                <button class="btn-primarys"><h3>Publish New Article</h3></button>
                <hr style="margin: 0;">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <form action="{{route('storeNews')}}" method="post" role="form" style="padding-top: 10px;"
                      enctype="multipart/form-data" class="contactForm">
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                   placeholder="News Title" required/>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <input type="file" class="form-control" style="padding:0px;" name="image" id="image" required/>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <textarea class="form-control" style="min-width: 1103px; min-height: 195px;max-width: 1103px; max-height: 195px;"
                                      name="description" placeholder="News Description" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('script')

@endsection