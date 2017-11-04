@extends('layouts.app')

@section('content')
<div class="container-fluid login_register header_area deximJobs_tabs">
    <div class="row">
        <div class="container main-container-home">
            <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/register') }}">Registrierung</a></li>
                    <li class="active"><a href="#login">Login</a></li>
                </ul>

                <div class="tab-content">
                    <div id="login" class="tab-pane fade in active white-text">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            <p>Login to your Recruiter account.</p>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form name="contact_us" class="contact_us" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">Name</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password-2" class="control-label">Password</label>
                                    <input type="password" name="password" id="password-2" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group submit">
                                    <label>Submit</label>
                                    <div class="cbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Remember me</span>
                                   </div>
                                </div>
                                <div class="form-group submit">
                                    <label>Submit</label>
                                    <input type="submit" name="submit" value="Sign in" class="signin" id="signin">
                                    <a href="{{ route('password.request') }}" class="lost_password">Passwort vergessen</a>
                                </div>
                            </form>
                        </div>
                        @include('blocks.sidebar-login')
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection