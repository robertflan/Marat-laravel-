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
            <h3>Locations</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Edit location #{{ $location->id }}</h4>
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

                        <form action="{{ url('/dashboard/locations/'.$location->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ $location->name }}" placeholder="Name of the location" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Select company</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($company->id === $location->company_id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="margin-bottom-50">
                                        <h5 class="margin-5">Stellenbeschreibung</h5>
                                        <textarea name="description" class="summernote">{{ $location->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="margin-5">Image</h5>
                                    <input name="image" type="file" class="dropify" @if($location->image) data-default-file="{{ url('/storage/'.$location->image) }}" @endif />

                                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                        <label for="slug">Slug</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="slug" class="form-control{{ $errors->has('slug') ? ' form-control-danger' : '' }}" value="{{ $location->slug }}" placeholder="URL slug" id="slug">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                        <label for="meta_title">Title</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_title" class="form-control{{ $errors->has('meta_title') ? ' form-control-danger' : '' }}" value="{{ $location->meta_title }}" placeholder="Meta title" id="meta_title">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
                                        <label for="meta_description">Description</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' form-control-danger' : '' }}" value="{{ $location->meta_description }}" placeholder="Meta description" id="meta_description">
                                        </div>
                                    </div>
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
        $('.dropify').dropify();
        $('.summernote').summernote({
            height: 350
        });
    });

</script>
<!-- End Page Scripts -->

</div>
</section>
@endsection