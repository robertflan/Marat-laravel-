@extends('layouts.app')

@section('content')
<div class="container-fluid login_register header_area deximJobs_tabs">
    <div class="row">
        <div class="container main-container">
            <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="tab" href="#lost-password">Lost Password ?</a></li>
                </ul>

                <div class="tab-content">
                    <div id="lost-password" class="tab-pane fade in active white-text">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <p>Lost your password? <br />
                                Please enter your email address. <br />
                                You will receive a link to create a new password via email.</p>
                            <form  name="contact_us" class="contact_us" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-mail Address</label>
                                    <input id="email" type="email" name="email" value="{{ $email or old('name') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group submit">
                                    <label>Submit</label>
                                    <input type="submit" name="submit" value="Reset Password" class="signin" id="signin">
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
