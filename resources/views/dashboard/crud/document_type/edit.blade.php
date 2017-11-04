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
            <h3>Document Types</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Edit document type #{{ $documentType->id }}</h4>
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

                        <form action="{{ url('/dashboard/document_types/'.$documentType->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ $documentType->name }}" placeholder="Name of the document type" id="name">
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Firma</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($company->id === $documentType->company_id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="form-group">
                                        <label>Document Group</label>
                                        <select name="document_group" class="select2">
                                        @foreach($document_groups as $document_group)
                                            <option value="{{ $document_group->id }}" @if($document_group->id === $documentType->document_group_id) selected @endif>{{ $document_group->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Beruf</label>
                                        <select name="category" class="select2">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id === $documentType->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="col-lg-4">
                                    {{-- <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default-outline @if($documentType->required) active @endif">
                                            <input type="checkbox" value="1" name="required" @if($documentType->required) checked="checked" @endif>
                                            Required
                                        </label>
                                    </div> --}}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success margin-inline">Update</button>
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
    });

</script>
<!-- End Page Scripts -->

</div>
</section>
@endsection