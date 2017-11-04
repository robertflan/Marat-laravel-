@extends('layouts.app')

@section('content')
<div class="container-fluid login_register header_area deximJobs_tabs">
    <div class="row">
        <div class="container main-container-home">
            <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#register-account">Registrierung</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>

                <div class="tab-content">
                    <div id="register-account" class="tab-pane fade in active white-text">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            <p>Register an account.</p>
                            <form name="contact_us" class="contact_us" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                @if(old('gender'))
                                <execute v-on:execute="register.gender = '{{ old('gender') }}'"></execute>
                                @endif

                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label class="control-label">Anrede</label>
                                    <div class="dropdown">
                                        <button class="filters_feilds btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @{{ register.gender || 'Wählen' }}
                                        <span class="glyphicon glyphicon-menu-down"></span>
                                        </button>

                                        <input type="hidden" name="gender" v-model="register.gender">
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <ul class="tiny_scrolling" id="style-3">
                                                <li><a v-on:click.prevent="register.gender = 'Herr'">Herr</a></li>
                                                <li><a v-on:click.prevent="register.gender = 'Frau'">Frau</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="control-label">Vorname</label>
                                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- <div class="form-group">
                                    <label for="cpassword" class="control-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="cpassword" required>
                                </div> -->

                                <div class="form-group submit">
                                    <label>Submit</label>
                                    <input type="submit" class="register">
                                    <a href="{{ route('password.request') }}" class="lost_password">Passwort vergessen</a>
                                </div>
                            </form>
                        </div>
                        @include('blocks.sidebar-register')
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection