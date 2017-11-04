@extends('layouts.dashboard')

@section('left-menu')
	@include('dashboard.blocks.left-menu')
@endsection

@section('top-menu')
	@include('dashboard.blocks.top-menu')
@endsection

@section('subfooter')
	@include('dashboard.blocks.subfooter')
@endsection

@section('content')
<section class="page-content">
	<div class="page-content-inner">

	@if (Session::has('message'))
	    <div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

    <section class="panel">
        <div class="panel-heading">
            <h3>Users</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Create user</h4>
                        <br />

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('/dashboard/users') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-stack font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="" placeholder="Name of the user" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                        <label for="last_name">Last name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' form-control-danger' : '' }}" value="" placeholder="Last name of the user" id="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Select gender</label>
                                        <select class="form-control" name="gender">
                                        <option>Herr</option>
                                        <option>Frau</option>
                                        </select>
                                    </div>
                                     <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label for="last_name">Email</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" value="" placeholder="Enter your email" id="email">
                                        </div>
                                    </div>
                                     <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label for="last_name">Password</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" value="" placeholder="Enter your password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="roles[]" class="select2" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default-outline">
                                            <input type="checkbox" value="1" name="activated">
                                            Activated
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success margin-inline">Create new user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Scripts -->
<script>

    $(function() {
        $('.select2').select2();
        // $('.dropify').dropify();
        // $('.summernote').summernote({
        //     height: 350
        // });
    });

</script>
<!-- End Page Scripts -->

</div>
</section>
@endsection