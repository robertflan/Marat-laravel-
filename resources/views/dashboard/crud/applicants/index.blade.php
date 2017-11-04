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
        	<!-- <div class="pull-right">
        		<a href="{{ url('/dashboard/applicants/create') }}">
                	<button type="button" class="btn btn-lg btn-success margin-inline">Create</button>
                </a>
            </div> -->
            <h3>Bewerberdatenbank</h3>
        </div>
        <div class="panel-body">
						<div class="btn-group margin-inline">
								<a href="/dashboard/applicants?status=active"><button type="button" class="btn btn-success">Aktiv</button></a>
								<a href="/dashboard/applicants?status=2"><button type="button" class="btn btn-primary">Einarbeitung</button></a>
								<a href="/dashboard/applicants?status=deactive"><button type="button" class="btn btn-default">Ausgeschieden</button></a>
						</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive margin-bottom-50">
                        <table id="applicants" class="table table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Name</th>
                                    <th>Beruf</th>
                                    <th>Ort</th>
                                    <th>Eingang</th>
                                    <th>Kontakt am</th>
                                    <th>Termin am</th>
                                    <th>Status</th>
                                    <th>Bearbeiter</th>
                                    <th>Ranking / (Wert)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidates as $candidate)
                            	<tr>
                                    <td>@if($candidate->job) {{ $candidate->job->name }} @else No job selected @endif</td>
                                    <td>{{ $candidate->applicant->fullname }}</td>
                                    <td>@if($candidate->job) @if($candidate->job->categories) @foreach($candidate->job->categories as $cat) {{ $cat->short_name }} @endforeach @endif @endif</td>
                                    <td>@if($candidate->job) {{ $candidate->job->location->name }} @endif</td>
                                    <td>{{ $candidate->created_at }}</td>
                                    <td>{{ $candidate->contact_at }}</td>
                                    <td>{{ $candidate->interview_at }}</td>
                                    <td>{{ $candidate->short_status }}</td>
                                    <td>@if($candidate->manager) {{ $candidate->manager->name }} {{ $candidate->manager->last_name }} @endif</td>
                                    <td>{{ $candidate->rating }}</td>
                                    <td><a href="{{ url('/dashboard/applicants/' . $candidate->id) }}">
                                            <button type="button" class="btn btn-success-outline">
                                                <i class="icmn-link" aria-hidden="true"></i>
                                                Akte
                                            </button>
                                        </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Job</th>
                                    <th>Name</th>
                                    <th>Beruf</th>
                                    <th>Ort</th>
                                    <th>Eingang</th>
                                    <th>Kontakt am</th>
                                    <th>Termin am</th>
                                    <th>Status</th>
                                    <th>Bearbeiter</th>
                                    <th>Ranking / (Wert)</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Scripts -->
    <script>
        $(function(){
            $('#applicants').DataTable({
                responsive: true,
                //serverSide: true,
                //processing: true,
                //ajax: '{{ url("/dashboard/applicants/data") }}',
                order: [[4, 'desc']],
                columns: [
                    {data: 'job', name: 'jobs.name'},
                    {data: 'name', orderable: false},
                    {data: 'category', name: 'categories.name'},
                    {data: 'location', name: 'locations.name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'contact_at', name: 'contact_at'},
                    {data: 'interview_at', name: 'interview_at'},
                    {data: 'status', name: 'status'},
                    {data: 'manager', name: 'manager'},
                    {data: 'rating', name: 'rating'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
    <!-- End Page Scripts -->

</div>
</section>
@endsection
