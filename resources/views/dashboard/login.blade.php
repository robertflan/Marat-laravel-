@extends('layouts.dashboard')

@section('content')
<section class="page-content">
	<div class="page-content-inner single-page-login-alpha" style="background-image: url({{ asset('assets/common/img/temp/login/5.jpg') }});justify-content: flex-start;">

	    <!-- Login Alpha Page -->
	    <div class="single-page-block-header">
	        <div class="row">
	            <div class="col-lg-4">
	                <div class="logo">
	                    <a href="javascript: history.back();">
	                        <img src="{{ asset('assets/common/img/logo-inverse.png') }}" alt="Clean UI Admin Template" />
	                    </a>
	                </div>
	            </div>
	            <div class="col-lg-8">
	                <div class="single-page-block-header-menu">
	                    <ul class="list-unstyled list-inline">
	                        <li><a href="javascript: history.back();">&larr; Back</a></li>
	                        <li class="active"><a href="javascript: void(0);">Login</a></li>
	                        <li><a href="{{ url('/') }}">Career protal</a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="single-page-block">
	        <div class="row">
	            <div class="col-xl-12">
	                <!-- <div class="promo-text">
	                    <h1>Welcome to HR manager dashboard</h1>
	                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
	                </div> -->
	                <div class="single-page-block-inner">
	                    <div class="single-page-block-form">
	                        <h3 class="text-center">
	                            <i class="icmn-enter margin-right-10"></i>
	                            Login Form
	                        </h3>
	                        <br />
	                        <form id="form-validation" name="form-validation" method="POST" action="{{ route('login') }}">
	                        	{{ csrf_field() }}
	                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                                <label for="validation-email" class="form-label">Email</label>
	                                <input id="validation-email"
	                                       class="form-control"
	                                       placeholder="Email"
	                                       value="{{ old('email') }}"
	                                       name="email"
	                                       type="text"
	                                       data-validation="[EMAIL]"
	                                       required autofocus>
	                                @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
	                            </div>
	                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                                <label for="validation-password" class="form-label">Password</label>
	                                <input id="validation-password"
	                                       class="form-control password"
	                                       name="password"
	                                       type="password" data-validation="[L>=8]"
	                                       data-validation-message="$ must be at least 8 characters"
	                                       placeholder="Password"
	                                       required>
	                                @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
	                            </div>
	                            <div class="form-group">
	                                <a href="{{ route('password.request') }}" class="pull-right link-blue link-underlined">Forgot Password?</a>
	                                <div class="checkbox">
	                                    <label>
	                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
	                                        Remember me
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn btn-primary width-150">Sign In</button>
	                                <!-- <span class="register-link">
	                                    <a href="" class="link-blue link-underlined">Register</a> if you don't have account
	                                </span> -->
	                            </div>
	                            <!-- <div class="form-group">
	                                <div class="social-login">
	                                    <span class="title">
	                                        Use another service to Log In
	                                    </span>
	                                    <div class="social-container">
	                                        <a href="javascript: void(0);" class="btn btn-icon">
	                                            <i class="icmn-facebook"></i>
	                                        </a>
	                                        <a href="javascript: void(0);" class="btn btn-icon">
	                                            <i class="icmn-google"></i>
	                                        </a>
	                                        <a href="javascript: void(0);" class="btn btn-icon">
	                                            <i class="icmn-windows"></i>
	                                        </a>
	                                        <a href="javascript: void(0);" class="btn btn-icon">
	                                            <i class="icmn-twitter"></i>
	                                        </a>
	                                    </div>
	                                </div>
	                            </div> -->
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- <div class="single-page-block-footer text-center">
	        <ul class="list-unstyled list-inline">
	            <li><a href="javascript: void(0);">Terms of Use</a></li>
	            <li class="active"><a href="javascript: void(0);">Compliance</a></li>
	            <li><a href="javascript: void(0);">Confidential Information</a></li>
	            <li><a href="javascript: void(0);">Support</a></li>
	            <li><a href="javascript: void(0);">Contacts</a></li>
	        </ul>
	    </div> -->
	    <!-- End Login Alpha Page -->

	</div>

	<!-- Page Scripts -->
	<script>
	    $(function() {

	        // Add class to body for change layout settings
	        $('body').addClass('single-page');

	        // Form Validation
	        $('#form-validation').validate({
	            submit: {
	                settings: {
	                    inputContainer: '.form-group',
	                    errorListClass: 'form-control-error',
	                    errorClass: 'has-danger'
	                }
	            }
	        });

	        // Show/Hide Password
	        $('.password').password({
	            eyeClass: '',
	            eyeOpenClass: 'icmn-eye',
	            eyeCloseClass: 'icmn-eye-blocked'
	        });

	    });
	</script>
	<!-- End Page Scripts -->
</section>
@endsection