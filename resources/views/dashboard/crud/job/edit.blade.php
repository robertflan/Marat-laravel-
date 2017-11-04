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
            <h3>Stellen</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Edit stellen #{{ $job->id }}</h4>
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

                        <form action="{{ url('/dashboard/jobs/'.$job->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ $job->name }}" placeholder="Name of the job post" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Firma</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($company->id === $job->company_id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Job type</label>
                                        <select class="form-control" name="type">
                                        @foreach(config('enums.jobtypes') as $job_type)
                                            <option value="{{ $job_type }}" @if($job_type == $job->type) selected @endif>{{ $job_type }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group{{ $errors->has('starts_at') ? ' has-danger' : '' }}">
                                        <label for="starts_at">Beginn</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="starts_at" class="form-control{{ $errors->has('starts_at') ? ' form-control-danger' : '' }}" value="{{ $job->starts_at }}" placeholder="ab sofort" id="starts_at">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Verantwortlich</label>
                                        <select class="form-control" name="manager">
                                        @foreach($managers->users as $manager)
                                            <option value="{{ $manager->id }}" @if($manager->id == $job->manager_id) selected @endif>{{ $manager->name }} {{ $manager->last_name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Beruf</label>
                                        <select name="categories[]" class="select2" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @foreach($job->categories as $cat) @if($category->id == $cat->id) selected @endif @endforeach>{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Questionnaires</label>
                                        <select name="questionnaires[]" class="select2" multiple>
                                        @foreach($questionnaires as $questionnaire)
                                            <option value="{{ $questionnaire->id }}"
                                            {{in_array($questionnaire->id, old('questionnaires')?:[]) ? 'selected' :(in_array($questionnaire->id, $job->questionnaires->pluck('id')->toArray())? 'selected' :'') }}>{{ $questionnaire->title }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Location</label>
                                        <select name="location" class="select2">
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" @if($location->id == $job->location_id) selected @endif>{{ $location->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    {{--<div class="form-group">
                                        <label>Location</label>
                                        <select name="locations[]" class="select2" multiple>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" @foreach($job->locations as $loc) @if($location->id == $loc->id) selected @endif @endforeach>{{ $location->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>--}}

                                    <div class="margin-bottom-50">
                                        <h5 class="margin-5">Stellenbeschreibung</h5>
                                        <textarea name="description" class="summernote">{{ $job->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
																		<div class="btn-group" data-toggle="buttons">
																				<label class="btn btn-default-outline @if($job->active) active @endif">
																						<input type="checkbox" value="1" name="active" @if($job->active) checked="checked" @endif>
																						Aktiv
																				</label>
																		</div>
																		@if($job->inactive_at)
																		<p>Inaktiv seit: {{ $job->inactive_at }}</p>
																		@elseif(!$job->active && !$job->inactive_at)
																		<p>Select active to publish the job</p>
																		@endif
                                    <h5 class="margin-5">Image</h5>
                                    <input name="image" type="file" class="dropify" @if($job->image) data-default-file="{{ url('/storage/'.$job->image) }}" @endif />

                                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                        <label for="slug">Slug</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="slug" class="form-control{{ $errors->has('slug') ? ' form-control-danger' : '' }}" value="{{ $job->slug }}" placeholder="URL slug" id="slug">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                        <label for="meta_title">Title</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_title" class="form-control{{ $errors->has('meta_title') ? ' form-control-danger' : '' }}" value="{{ $job->meta_title }}" placeholder="Meta title" id="meta_title">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
                                        <label for="meta_description">Description</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-link font-green"></i>
                                            <input type="text" name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' form-control-danger' : '' }}" value="{{ $job->meta_description }}" placeholder="Meta description" id="meta_description">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Tags</label>
                                        <select name="tags[]" class="select2-tags" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->name }}" @foreach($job->tags as $tg) @if($tag->name == $tg->name) selected @endif @endforeach>{{ $tag->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success margin-inline">Save</button>
														@if(!$job->active)
														<a href="/jobs/{{ $job->id }}" target="_blank" class="btn btn-lg btn-success-outline margin-inline">Vorschau</a>
														@endif
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
        $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
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
