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
            <h3>Document Groups</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Edit document group #{{ $documentGroup->id }}</h4>
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

                        <form action="{{ url('/dashboard/document_groups/'.$documentGroup->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <div class="row">
                                <div class="col-lg-8">
																		<div class="form-group">
																				<label>Tab name</label>
																				<select class="form-control" name="tab_name">
																				@foreach(config('enums.tabnames') as $tab_name)
																						<option value="{{ $tab_name }}" @if($tab_name == $documentGroup->tab_name) selected @endif>{{ $tab_name }}</option>
																				@endforeach
																				</select>
																		</div>

                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ $documentGroup->name }}" placeholder="Name of the document group" id="name">
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Firma</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($company->id === $documentGroup->company_id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                        </select>
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
