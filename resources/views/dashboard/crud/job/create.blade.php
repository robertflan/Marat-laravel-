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
            <h3>Job Posts</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <h4>Create job post</h4>
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

                        <form action="{{ url('/dashboard/jobs') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label for="name">Name</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-stack font-green"></i>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ old('name') }}" placeholder="Name of the job post" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Firma</label>
                                        <select class="form-control" name="company">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Job type</label>
                                        <select class="form-control" name="type">
                                        @foreach(config('enums.jobtypes') as $job_type)
                                            <option value="{{ $job_type }}">{{ $job_type }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group{{ $errors->has('starts_at') ? ' has-danger' : '' }}">
                                        <label for="starts_at">Beginn</label>
                                        <div class="form-input-icon">
                                            <i class="icmn-office font-green"></i>
                                            <input type="text" name="starts_at" class="form-control{{ $errors->has('starts_at') ? ' form-control-danger' : '' }}" placeholder="ab sofort" id="starts_at">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Verantwortlich</label>
                                        <select class="form-control" name="manager">
                                        @foreach($managers->users as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }} {{ $manager->last_name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Location</label>
                                        <select name="location" class="select2">
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Beruf</label>
                                        <select name="categories[]" class="select2" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Questionnaires</label>
                                        <select name="questionnaires[]" class="select2" multiple>
                                        @foreach($questionnaires as $questionnaire)
                                            <option value="{{ $questionnaire->id }}" 
                                                {{in_array($questionnaire->id, old('questionnaires')?:[]) ? 'selected' :'' }}>{{ $questionnaire->title }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label>Location</label>
                                        <select name="locations[]" class="select2" multiple>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                        </select>
                                    </div> -->

                                    <div class="margin-bottom-50">
                                        <h5 class="margin-5">Stellenbeschreibung</h5>
                                        <textarea name="description" class="summernote">@if(old('description')) {{ old('description') }} @else <h3>Company Introduction</h3><p>[[Write a short and catchy paragraph about your company. Make sure to provide information about the company’s culture, perks, and benefits. Mention office hours, remote working possibilities, and everything else you think of that makes your company interesting.]]</p><p><br></p><h3>Job Description</h3><p>We are looking for a PHP Developer responsible for managing back-end services and the interchange of data between the server and the users. Your primary focus will be the development of all server-side logic, definition and maintenance of the central database, and ensuring high performance and responsiveness to requests from the front-end. You will also be responsible for integrating the front-end elements built by your co-workers into the application. Therefore, a basic understanding of front-end technologies is necessary as well.</p><p><br></p><h3>Responsibilities</h3><p>&nbsp; - Integration of user-facing elements developed by front-end developers<br></p><p>&nbsp; - Build efficient, testable, and reusable PHP modules</p><p>&nbsp; - Solve complex performance problems and architectural challenges</p><p>&nbsp; - Integration of data storage solutions [[may include databases, key-value stores, blob stores, etc.]]</p><p>&nbsp; - [[Add other responsibilities here that are relevant]]</p><p><br></p><h3>Skills And Qualifications</h3><p>&nbsp; - Strong knowledge of PHP web frameworks [[such as Laravel, Yii, etc depending on your technology stack]]<br></p><p>&nbsp; - Understanding the fully synchronous behavior of PHP</p><p>&nbsp; - Understanding of MVC design patterns</p><p>&nbsp; - Basic understanding of front-end technologies, such as JavaScript, HTML5, and CSS3</p><p>&nbsp; - Knowledge of object oriented PHP programming</p><p>&nbsp; - Understanding accessibility and security compliance [[Depending on the specific project]]</p><p>&nbsp; - Strong knowledge of the common PHP or web server exploits and their solutions</p><p>&nbsp; - Understanding fundamental design principles behind a scalable application</p><p>&nbsp; - User authentication and authorization between multiple systems, servers, and environments</p><p>&nbsp; - Integration of multiple data sources and databases into one system</p><p>&nbsp; - Familiarity with limitations of PHP as a platform and its workarounds</p><p>&nbsp; - Creating database schemas that represent and support business processes</p><p>&nbsp; - Familiarity with SQL/NoSQL databases and their declarative query languages</p><p>&nbsp; - Proficient understanding of code versioning tools, such as Git</p><p>&nbsp; - [[Make sure to mention other frameworks, libraries, or any other technology related to your development stack]]</p><p>&nbsp; - [[List education level or certification you require]]</p> @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
																		<div class="btn-group" data-toggle="buttons">
																				<label class="btn btn-default-outline">
																						<input type="checkbox" value="1" name="active">
																						Active
																				</label>
																		</div>
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

                                    <div class="form-group">
                                        <label>Tags</label>
                                        <select name="tags[]" class="select2-tags" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                        @endforeach
                                        </select>
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
        $('.select2').select2({
            placeholder: "Select"
        });
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
