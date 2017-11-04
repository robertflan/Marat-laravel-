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
        		<a href="{{ route('questionnaire.create') }}">
                	<button type="button" class="btn btn-success width-150">Create</button>
                </a>
            </div>
            <h3>Questionnaires</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                	@if(!$questionnaires->isEmpty())
                    <div class="table-responsive margin-bottom-50">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Aktion</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	@foreach($questionnaires as $questionnaire)
                                <tr>
                                    <td>{{ $questionnaire->id }}</td>
                                    <td>{{ $questionnaire->title }}</td>
                                    <td>{{ $questionnaire->description }}</td>
                                    <td>{{ $questionnaire->user->fullname }}</td>
                                    <td>
                                        <div class="btn-group" aria-label="" role="group">
    			                            <a href="{{ route('questionnaire.edit', $questionnaire->id) }}">
    				                            <button type="button" class="btn btn-primary">
    				                                <i class="icmn-pencil3" aria-hidden="true"></i>
    				                                Edit
    				                            </button>
    			                            </a>
    						                <form action="{{ route('questionnaire.destroy', $questionnaire->id) }}" class="d-inline" method="POST">
    						                	<input name="_method" type="hidden" value="DELETE">
    						                	{{ csrf_field() }}
    						                	<button type="submit" class="btn btn-danger confirmation">
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