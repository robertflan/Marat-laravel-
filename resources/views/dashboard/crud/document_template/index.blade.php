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
                <button id="upload_button" type="button" class="btn btn-primary margin-inline" data-toggle="modal" data-target="#document_upload_modal">Create</button>

            </div>
            
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Document Template</h3>
                	@if(!$document_groups->isEmpty())
                    <div class="table-responsive margin-bottom-50">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>DocumentGroupName</th>
                                    {{-- <th>Firma</th> --}}
                                    <th>Tab Name</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>DocumentGroupName</th>
                                    {{-- <th>Firma</th> --}}
                                    <th>Tab Name</th>
                                    <th>Count</th>
                                </tr>
                            </tfoot>
                            @if(!$document_groups->isEmpty())
                            <tbody>
                            	@foreach($document_groups as $item)
                                <a href="{{ url('/dashboard/document_templates/' . $item->id) }}">
                                <tr class="doc_type_select">
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('/dashboard/document_templates/' . $item->id) }}">{{ $item->name }}</a></td>
                                    <td><a href="{{ url('/dashboard/document_templates/' . $item->id) }}">{{ $item->tab_name}}</a></td>
                                    <td><a href="{{ url('/dashboard/document_templates/' . $item->id) }}">{{ $item->document_types->count() }}</a></td>
                                    <!-- <td>
                                    <div class="btn-group" aria-label="" role="group">
						                <form action="{{ url('/dashboard/document_groups/' . $item->id) }}" class="d-inline" method="POST">
						                	<input name="_method" type="hidden" value="DELETE">
						                	{{ csrf_field() }}
						                	<button type="submit" class="btn btn-danger">
				                                <i class="icmn-bin" aria-hidden="true"></i>
				                                Delete
				                            </button>
						                </form>
			                        </div> -->
                                    </td>
                                </tr>
                                </a>
                                @endforeach
                            </tbody>
                            @else
                                <div class="alert alert-warning">Nothing here. Go ahead and create new record.</div>
                            @endif
                        </table>

                    </div>
	                @else
						<div class="alert alert-warning">Nothing here. Go ahead and create new record.</div>
	                @endif
                </div>
                <div class="col-lg-6">
                    <!-- <h3 class="text-left">Documents</h3> -->
                        <table class="table table-dark table-hover">
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->id }}</td>
                                        <td>{{ $document->name }}</td>
                                        <!-- <td>
                                            <div class="btn-group" aria-label="" role="group">
                                                <form action="{{ url('/dashboard/document_groups/' . $item->id) }}" class="d-inline" method="POST">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="icmn-bin" aria-hidden="true"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        <form action="{{ url('/dashboard/document_templates/store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;width: 30%;" for="doc_type">Category</label>
                                        <!-- <input type="text" class="col-lg-6 form-control" style="width: 60%;" name="doc_title" id="doc_title_temp" required/> -->
                                        <select class="col-lg-6 form-control" style="width: 60%;" name="doc_title_temp" id="doc_title_temp">
                                                @foreach($document_groups as $document)
                                                <option value="{{ $document->id }}">{{$document->name}}</option>
                                                @endforeach
                                        </select> 
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;width: 30%;" for="doc_type">Name der Vorlage</label>
                                            <select class="col-lg-6 form-control" style="width: 60%;" name="doc_type" id="doc_type">
                                                @foreach($document_types as $document)
                                                <option value="{{ $document->id }}">{{$document->name}}</option>
                                                @endforeach
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