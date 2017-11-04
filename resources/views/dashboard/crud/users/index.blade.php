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
        	<div class="pull-right">
        		<a href="{{ url('/dashboard/users/create') }}">
                	<button type="button" class="btn btn-lg btn-success margin-inline">Create</button>
                </a>
            </div>
            <h3>Users</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                	@if(!$users->isEmpty())
                    <div class="table-responsive margin-bottom-50">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Last name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Activated</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Last name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Activated</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	@foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->activated }}</td>
                                    <td>
                                            @foreach($user->roles as $role)
                                            <span>{{ $role->name }}</span>
                                            @endforeach
                                    </td>
                                    <td>
                                    <div class="btn-group" aria-label="" role="group">
                                    	<!-- <a href="{{ url('/dashboard/categories/' . $user->id) }}">
	                                    	<button type="button" class="btn btn-success-outline">
				                                <i class="icmn-link" aria-hidden="true"></i>
				                                View
				                            </button>
			                            </a> -->
			                            <a href="{{ url('/dashboard/users/' . $user->id . '/edit') }}">
				                            <button type="button" class="btn btn-primary">
				                                <i class="icmn-pencil3" aria-hidden="true"></i>
				                                Edit
				                            </button>
			                            </a>
						                <form action="{{ url('/dashboard/users/' . $user->id) }}" class="d-inline" method="POST">
						                	<input name="_method" type="hidden" value="DELETE">
						                	{{ csrf_field() }}
						                	<button type="submit" class="btn btn-danger">
				                                <i class="icmn-bin" aria-hidden="true"></i>
				                                Delete
				                            </button>
						                </form>
			                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
	                @else
						<div class="alert alert-warning">Nothing here. Go ahead and create new record.</div>
	                @endif
                </div>
            </div>
        </div>
    </section>

</div>
</section>
@endsection