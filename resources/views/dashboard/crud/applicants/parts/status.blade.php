<div class="tab-pane" id="status" role="tabpanel">
    @if($application->job && !$application->job->questionnaires->isEmpty())
    <div class="dropdown margin-inline pull-right">
        <button type="button" class="btn btn-info-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Questionnaires
        </button>
        <ul class="dropdown-menu" aria-labelledby="" role="menu">
            @foreach($application->job->questionnaires as $questionnaire)
                <a class="dropdown-item questionnaire" data-status="{{$questionnaire->status}}" href="javascript: void(0)"
                    data-toggle="modal" data-target="#modal-{{$questionnaire->status}}">{{$questionnaire->title . ' (' . $questionnaire->status  . ')'}}</a>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/dashboard/applicants/'.$application->id.'/status') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <br />
        <h5>Status</h5>
        @if($application->job)
        <p><strong>Stellen:</strong> <a href="/jobs/{{ $application->job->id }}">{{ $application->job->name }}</a></p>
        <p><strong>Beruf:</strong> {{ $application->job->categories[0]->name }}</p>
        <p><strong>Ort:</strong> {{ $application->job->location->name }}</p>
        @endif
        <p><strong>Eingang:</strong> {{ $application->created_at }}</p>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="contact">Kontakt am</label>
                    <label class="input-group datepicker-init">
                    <input name="contact_at" type="text" class="form-control" id="contact" value="{{ $application->contact_at }}">
                    <span class="input-group-addon">
                    <i class="icmn-calendar"></i>
                    </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="interview">Termin am</label>
                    <label class="input-group datepicker-init">
                    <input name="interview_at" type="text" class="form-control" id="interview" value="{{ $application->interview_at }}">
                    <span class="input-group-addon">
                    <i class="icmn-calendar"></i>
                    </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="status_field">Status</label>
                    <select name="status" class="form-control selectpicker" data-live-search="true" id="status_field">
                    @foreach(config('enums.status') as $status)
                    <option @if($application->status == $status) selected @endif>{{ $status }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="comment" placeholder="Write your comment here">{{ $application->comment }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="form-group">
                <button type="submit" class="btn width-150 btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

@foreach($application->job->questionnaires as $questionnaire)
    @include('dashboard.crud.applicants.parts.questionnaire_modals')
@endforeach

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/autoresize.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.questionnaire-form textarea').autoResize();
    $('.select2').select2({
        allowClear: true,
        width: '100%',
    });

    $('select[name=status]').on('change', function(){
        $('#modal-'+this.value).modal('show');
    });
})    
</script>
@endpush