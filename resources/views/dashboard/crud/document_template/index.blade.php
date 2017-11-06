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
        		<a href="{{ url('/dashboard/document_groups/create') }}">
                	<button type="button" class="btn btn-lg btn-success margin-inline">Create</button>
                </a>
            </div>
            <h3>Document Category</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                	@if(!$document_groups->isEmpty())
                    <div class="table-responsive margin-bottom-50">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    {{-- <th>Firma</th> --}}
                                    <th>Tab Name</th>
                                    <th>Count</th>
                                    <th>Template Name</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    {{-- <th>Firma</th> --}}
                                    <th>Tab Name</th>
                                    <th>Count</th>
                                    <th>Template Name</th>
                                    <th>Aktion</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	@foreach($document_groups as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                         <a href="#">
                                            <span id="upload_button" type="button"  data-toggle="modal" data-target="#document_upload_modal">{{ $item->name }}</span>
                                         </a>

                                    </td>
                                    {{-- <td>{{ $item->company->name }}</td> --}}
                                    <td>{{ $item->tab_name}}</td>
                                    <td>{{ $item->document_types->count() }}</td>
                                    <td>Template Name</td>
                                    <td>
                                    <div class="btn-group" aria-label="" role="group">
			                            <a href="{{ url('/dashboard/document_groups/' . $item->id . '/edit') }}">
				                            <button type="button" class="btn btn-primary">
				                                <i class="icmn-pencil3" aria-hidden="true"></i>
				                                Edit
				                            </button>
			                            </a>
						                <form action="{{ url('/dashboard/document_groups/' . $item->id) }}" class="d-inline" method="POST">
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
<div class="modal fade" id="document_upload_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Vorlage hinzufügen</h4>
                        </div>
                        <form action="{{ url('#') }}" method="POST" enctype="multipart/form-data">
                           
                            <div class="modal-body">
                                <div class="form-group">
                                    
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;width: 30%;" for="doc_type">Category</label>
                                        <input type="text" class="col-lg-6 form-control" style="width: 60%;" name="doc_title" id="doc_title" required/>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;width: 30%;" for="doc_type">Name der Vorlage</label>
                                        <select class="col-lg-6 form-control" style="width: 60%;" name="doc_type" id="doc_type">
                                            <option>ABC</option>
                                        </select>
                                    </div>
    
                                    <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 2px;width: 30%;" for="doc_type">File</label>
                                        <input type="file" class="col-lg-6 form-control dropify" style="width: 60%;" name="doc_file" id="doc_file" required/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Hochladen</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
</section>
@endsection