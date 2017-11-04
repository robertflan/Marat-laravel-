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
            <h3>Categories</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Create category</h4>
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

                        <form action="{{ url('/dashboard/categories') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-stack font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ old('name') }}" placeholder="Name of the category" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('short_name') ? ' has-danger' : '' }}">
                                        <label for="short_name">Short name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="short_name" class="form-control{{ $errors->has('short_name') ? ' form-control-danger' : '' }}" value="{{ old('name') }}" placeholder="Short name of the category" id="short_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Select company</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="margin-bottom-50">
                                        <h5 class="margin-5">Stellenbeschreibung</h5>
                                        <textarea name="description" class="summernote">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="margin-5">Image</h5>
                                    <input name="image" type="file" class="dropify" />

                                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                        <label for="slug">Slug</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="slug" class="form-control{{ $errors->has('slug') ? ' form-control-danger' : '' }}" value="{{ old('slug') }}" placeholder="URL slug" id="slug">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                        <label for="meta_title">Title</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_title" class="form-control{{ $errors->has('meta_title') ? ' form-control-danger' : '' }}" value="{{ old('meta_title') }}" placeholder="Meta title" id="meta_title">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
                                        <label for="meta_description">Description</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' form-control-danger' : '' }}" value="{{ old('meta_description') }}" placeholder="Meta description" id="meta_description">
                                        </div>
                                    </div>

                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default-outline">
                                            <input type="checkbox" value="1" name="popular" @if(old('is_popular')) checked @endif>
                                            Popular
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success margin-inline">Create</button>
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