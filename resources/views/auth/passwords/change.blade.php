@extends('layouts.app')

@section('content')
<div class="container-fluid login_register header_area deximJobs_tabs">
    <div class="row">
        <div class="container main-container-home">
            <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#login">Change Password</a></li>
                </ul>

                <div class="tab-content">
                    <div id="login" class="tab-pane fade in active white-text">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form name="contact_us" class="contact_us" method="POST" action="{{ url('/my/change_password/save/'.Auth::user()->id) }}">
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="email" class="control-label">Old password</label>
                                    <input id="email" type="password" name="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="password-2" class="control-label"> New password</label>
                                    <input type="password" name="password_2" id="password-2" required>
                                </div>
                                <div class="form-group submit">
                                    <label>Submit</label>
                                    <input type="submit" name="submit" value="Save" class="signin" id="signin">
                                </div>
                            </form>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection