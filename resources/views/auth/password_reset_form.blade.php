@extends('layouts.app')
@section('content')

    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Update Password</div>
                        <div class="panel-body">
                            @if(Session::has('error'))
                                <div class="alert alert-danger margin-bottom-0">
                                    <strong>Error!</strong> {!! Session::get('error') !!}
                                </div>
                                <div class="margin-top-20"><a href="{{route('home')}}">Back To Home</a></div>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success margin-bottom-0">
                                    <strong>Success!</strong> {!! Session::get('success') !!}
                                </div>
                                <div class="margin-top-20"><a href="{{route('login')}}">Sign In</a></div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{route('savePasswordReset', $token)}}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection