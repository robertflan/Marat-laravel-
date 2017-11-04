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
        		<a href="{{ url('/dashboard/jobs/create') }}">
                	<button type="button" class="btn btn-lg btn-success margin-inline">Erstellen</button>
                </a>
            </div>
            <h3>Stellen</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
									<div class="btn-group margin-inline">
											<a href="/dashboard/jobs?active=1"><button type="button" class="btn btn-success">Aktiv</button></a>
											<a href="/dashboard/jobs?active=2"><button type="button" class="btn btn-default">Inaktiv</button></a>
									</div>
                	@if(!$jobs->isEmpty())
                    <div class="table-responsive margin-bottom-50">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Firma</th>
                                    <th>Beruf</th>
                                    <th>Beginn</th>
                                    <th>Verantwortlich</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Firma</th>
                                    <th>Beruf</th>
                                    <th>Beginn</th>
                                    <th>Verantwortlich</th>
                                    <th>Aktion</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	@foreach($jobs as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->company->name }}</td>
                                    <td>
                                    @foreach($item->categories as $category)
                                        <span>{{ $category->name }}</span>
                                    @endforeach
                                    </td>
                                    <td>{{ $item->starts_at }}</td>
                                    <td>{{ $item->manager->name }} {{ $item->manager->last_name }}</td>
                                    <td>
																		@if($item->active)
                                    <div class="btn-group" aria-label="" role="group">
                                    	<a href="{{ url('/jobs/' . $item->id) }}">
	                                    	<button type="button" class="btn btn-success-outline">
				                                <i class="icmn-link" aria-hidden="true"></i>
				                                View
				                            </button>
																		@else
																		<div class="btn-group" aria-label="" role="group">
                                    	<a href="{{ url('/jobs/' . $item->id) }}" target="_blank">
	                                    	<button type="button" class="btn btn-success-outline">
				                                <i class="icmn-link" aria-hidden="true"></i>
				                                Vorschau
				                            </button>
																		@endif
			                            </a>
			                            <a href="{{ url('/dashboard/jobs/' . $item->id . '/edit') }}">
				                            <button type="button" class="btn btn-primary">
				                                <i class="icmn-pencil3" aria-hidden="true"></i>
				                                Edit
				                            </button>
			                            </a>
						                <form action="{{ url('/dashboard/jobs/' . $item->id) }}" class="d-inline" method="POST">
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
