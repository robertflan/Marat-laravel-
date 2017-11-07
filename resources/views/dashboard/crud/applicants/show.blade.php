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

         <div class="modal fade" id="document_upload_modal_upload" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Upload Contract</h4>
                        </div>
                        <form action="{{ url('/dashboard/applicants/store_contract') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Art</label>
                                        <select class="col-lg-6 form-control" style="width: 80%;" name="doc_type" id="doc_type">
                                            <option>ABC</option>
                                        </select>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Titel</label>
                                        <input type="text" class="col-lg-6 form-control" style="width: 80%;" name="doc_title" id="doc_title" required/>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Beginn</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_start_date" id="doc_start_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Ende</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_end_date" id="doc_end_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 2px;" for="doc_type">File</label>
                                        <input type="file" class="col-lg-6 form-control dropify" style="width: 80%;" name="doc_file" id="doc_file" required/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="document_upload_modal_new" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Neu aus Vorlage</h4>
                        </div>
                        <form action="{{ url('/dashboard/applicants/'.$application->id.'/doc_upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Category</label>
                                        <select class="col-lg-6 form-control" style="width: 80%;" name="doc_type" id="doc_type">
                                            <option>Category</option>
                                        </select>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Art</label>
                                        <select class="col-lg-6 form-control" style="width: 80%;" name="doc_type" id="doc_type">
                                            <option>Art</option>
                                        </select>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Template</label>
                                        <select class="col-lg-6 form-control" style="width: 80%;" name="doc_type" id="doc_type">
                                            <option>Template</option>
                                        </select>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Title</label>
                                        <input type="text" class="col-lg-6 form-control" style="width: 80%;" name="doc_title" id="doc_title" required/>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Beginn</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_start_date" id="doc_start_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Ende</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_end_date" id="doc_end_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 2px;" for="doc_type">File</label>
                                        <input type="file" class="col-lg-6 form-control dropify" style="width: 80%;" name="doc_file" id="doc_file" required/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <div class="modal fade" id="document_upload_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Upload document</h4>
                        </div>
                        <form action="{{ url('/dashboard/applicants/'.$application->id.'/doc_upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Art</label>
                                        <select class="col-lg-6 form-control" style="width: 80%;" name="doc_type" id="doc_type"></select>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Titel</label>
                                        <input type="text" class="col-lg-6 form-control" style="width: 80%;" name="doc_title" id="doc_title" required/>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Beginn</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_start_date" id="doc_start_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 20px;" for="doc_type">Ende</label>
                                        <label class="input-group datepicker-only-init" style="margin-right: 19px;margin-bottom: 0;">
                                            <input type="text" class="col-lg-5 form-control" name="doc_end_date" id="doc_end_date">
                                            <span class="input-group-addon">
                                                <i class="icmn-calendar"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                        <label class="col-lg-2 form-control-label" style="font-size: 16px;padding-left: 2px;" for="doc_type">File</label>
                                        <input type="file" class="col-lg-6 form-control dropify" style="width: 80%;" name="doc_file" id="doc_file" required/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Profile Header -->
            <nav class="top-submenu top-submenu-with-background">
                <div class="profile-header">
                    <div class="profile-header-info">
                        <div class="row">
                            <div class="col-xl-10 col-xl-offset-2">
                                <div class="profile-header-title">
                                    <h2>{{ $application->applicant->name }} {{ $application->applicant->last_name }}</h2>
                                    @if($application->job)
                                        <p>{{ $application->job->type }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- End Profile Header -->

            <!-- Profile -->
            <div class="row">
                <div class="col-xl-2">
                    <section class="panel profile-user">
                        <div class="panel-body">
                            <div class="profile-user-title text-center">
                                @if($application->applicant->profile->image)
                                    <a class="avatar" href="javascript:void(0);">
                                        <img src="/storage/{{ $application->applicant->profile->image }}">
                                    </a>
                                    <br />
                                @endif
                                <p>Letzte bearbeitung: @if($application->updated_by) {{ $application->updated_by_user->name }} {{ $application->updated_by_user->last_name }} @else {{ $application->applicant->name }} {{ $application->applicant->last_name }} @endif {{ $application->updated_at }}</p>
                                <p>Eingang: {{ $application->created_at }}</p>
                                <p>
                                    @if($application->applicant->activated)
                                        <span class="donut donut-success"></span>
                                        Aktiv
                                    @else
                                        <span class="donut donut-danger"></span>
                                        Nicht Aktiv
                                    @endif
                                </p>
                            </div>
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body">
                            <h6>Bewerbungsverfahren</h6>
                            <div class="btn-group-vertical btn-group-justified margin-bottom-50">
                                <button type="button" class="btn">Bewerbung</button>
                                <button type="button" class="btn">Einladung</button>
                                <button type="button" class="btn">GesprÃ¤ch</button>
                                <button type="button" class="btn">Einarbeitung</button>
                                <button type="button" class="btn">Ergebnis</button>
                            </div>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <button type="button" class="btn">Meldung</button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn">Sofort Meldung</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-10">
                    <section class="panel profile-user-content">
                        <div class="panel-body">
                            <div class="nav-tabs-horizontal">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#profile" role="tab">
                                            <i class="icmn-menu3"></i>
                                            Profil
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#contracts" role="tab">
                                            <i class="icmn-menu3"></i>
                                            Vertrage @if($doc_count['Vertrage']) <span class="label label-pill label-primary">{{ $doc_count['Vertrage'] }}</span> @endif
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#promotion" role="tab">
                                            <i class="icmn-bubbles5"></i>
                                            FÃ¶rderung
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#arc" role="tab">
                                            <i class="icmn-cog"></i>
                                            Bogen
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#documents" role="tab">
                                            <i class="icmn-cog"></i>
                                            Unterlagen @if($doc_count['Unterlagen']) <span class="label label-pill label-primary">{{ $doc_count['Unterlagen'] }}</span> @endif
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#write" role="tab">
                                            <i class="icmn-cog"></i>
                                            Besch./Schreiben
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#communication" role="tab">
                                            <i class="icmn-cog"></i>
                                            Kommunikation
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#events" role="tab">
                                            <i class="icmn-cog"></i>
                                            Termine
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#status" role="tab">
                                            <i class="icmn-cog"></i>
                                            Status
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content padding-vertical-20">
                                    <div class="tab-pane active" id="profile" role="tabpanel">
                                        <br />
                                        <h5>Profil</h5>
                                        <form action="{{ url('/dashboard/applicants/'.$application->id) }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="gender">Anrede</label>
                                                        <select name="gender" class="form-control selectpicker" id="gender">
                                                            <option @if($application->applicant->gender == 'Herr') selected @endif>Herr</option>
                                                            <option @if($application->applicant->gender == 'Frau') selected @endif>Frau</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="l1">Vorname</label>
                                                        <input name="name" type="text" class="form-control" id="name" value="{{ $application->applicant->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="last_name">Nachname</label>
                                                        <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $application->applicant->last_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="email">Email Adresse</label>
                                                        <input name="email" type="email" class="form-control" id="email" value="{{ $application->applicant->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="mobile_phone">Telefon</label>
                                                        <input name="mobile_phone" type="text" class="form-control" id="mobile_phone" value="{{ $application->applicant->profile->mobile_phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="dob">Geburtsdatum</label>
                                                        <label class="input-group datepicker-only-init">
                                                            <input name="dob" type="text" class="form-control" id="dob" value="{{ $application->applicant->profile->dob }}">
                                                            <span class="input-group-addon">
                                                                <i class="icmn-calendar"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="place_of_birth">Geburtsort</label>
                                                        <input name="place_of_birth" type="text" class="form-control" id="place_of_birth" value="{{ $application->applicant->profile->place_of_birth }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="nationality">NationalitÃ¤t</label>
                                                        <select name="nationality" class="form-control selectpicker" data-live-search="true" id="nationality">
                                                            @foreach(config('enums.nationality') as $nat)
                                                                <option @if($application->applicant->profile->nationality == $nat) selected @endif>{{ $nat }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="country">Land</label>
                                                        <input name="country" type="text" class="form-control" id="country" value="{{ $application->applicant->profile->country }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="street">Strasse</label>
                                                        <input name="street" type="text" class="form-control" id="street" value="{{ $application->applicant->profile->street }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="zip_code">PLZ</label>
                                                        <input name="zip_code" type="text" class="form-control" id="zip_code" value="{{ $application->applicant->profile->zip_code }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="city">Ort</label>
                                                        <input name="city" type="text" class="form-control" id="city" value="{{ $application->applicant->profile->city }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="url_linked">LinkedIn-, Xing-Profil oder eigene Webseite</label>
                                                        <input name="url_linked" type="text" class="form-control" id="url_linked" value="{{ $application->applicant->profile->url_linked }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="url_other">Weiterer Link</label>
                                                        <input name="url_other" type="text" class="form-control" id="url_other" value="{{ $application->applicant->profile->url_other }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="source">Wie bist du auf uns aufmerksam geworden?</label>
                                                        <input name="source" type="text" class="form-control" id="source" value="{{ $application->applicant->profile->source }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="recommend">Stelle durch einen Mitarbeitenden empfohlen wurde</label>
                                                        <input name="recommend" type="text" class="form-control" id="recommend" value="{{ $application->applicant->profile->recommend }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="qualification-tags">Qualifikationen</label>
                                                        <select name="qualifications[]" class="select2-tags" id="qualification-tags" multiple>
                                                            <option>Sprachliche Kenntnisse</option>
                                                            @foreach($document_groups->where('id', 2)->first()->document_types as $qual)
                                                                <option @foreach($application->applicant->profile->qualifications as $uq) @if($uq == $qual->name) selected @endif @endforeach>{{ $qual->name }}</option>
                                                            @endforeach
                                                        </select>
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
                                    <div class="tab-pane" id="contracts" role="tabpanel">
                                        <br />

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="document group"><h5 style="margin-bottom: 5px;">Kategorien</h5></label>
                                                    <select name="document_group" class="form-control selectpicker" data-live-search="true" id="document_group">
                                                        @foreach($document_groups as $item)
                                                            <option value="1">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br />

                                        <div class="table-responsive margin-bottom-50">
                                            <table class="table table-hover">
                                                <thead style="background:red;color:white;">
                                                <tr>
                                                    <th>Eingang</th>
                                                    <th>Titel2</th>
                                                    <th>Art</th>
                                                    <th>Beginn</th>
                                                    <th>Ende</th>
                                                    <th>Letzter Bearbeiter</th>
                                                    <th>Kommunikation</th>
                                                </tr>
                                                </thead>
                                                <tbody id="document_list">
                                                @foreach($documents as $document)
                                                    <tr>
                                                    <th>{{ $document->created_at }}</th>
                                                    <th>{{ $document->name }}</th>
                                                    <th>{{ $document->file }}</th>
                                                    <th>{{ $document->created_at }}</th>
                                                    <th>{{ $document->created_at }}</th>
                                                    <th>Letzter Bearbeiter</th>
                                                    <th>Kommunikation</th>
                                                    <tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <h5>
                                            <!-- Vertrage -->
                                            <div class="pull-right">
                                                <a href="#">
                                                <button id="upload_button" type="button" class="btn btn-primary margin-inline" data-toggle="modal" data-target="#document_upload_modal_new">Neu aus Vorlage</button>
                                                </a>

                                                <a href="#">
                                                    <button id="upload_button" type="button" class="btn btn-primary margin-inline" data-toggle="modal" data-target="#document_upload_modal_upload">Vertrag Hochladen</button>
                                                </a>

                                                <a href="#">
                                                    <button type="button" class="btn btn-primary margin-inline">Benachrichtigen</button>
                                                </a>
                                            </div>
                                        </h5>
                                    </div>
                                    <div class="tab-pane" id="promotion" role="tabpanel">
                                        <br />
                                        <h5>FÃ¶rderung</h5>
                                    </div>
                                    <div class="tab-pane" id="arc" role="tabpanel">
                                        <br />
                                        <h5>Bogen</h5>
                                    </div>
                                    <div class="tab-pane" id="documents" role="tabpanel">
                                        <br />
                                        <h5>
                                            <!-- Unterlagen -->
                                            <div class="pull-right">
                                                <a href="#">
                                                    <button type="button" class="btn btn-primary margin-inline" data-toggle="modal" data-target="#document_upload_modal">Dokument hochladen</button>
                                                </a>

                                                <a href="#">
                                                    <button type="button" class="btn btn-primary margin-inline">Benachrichtigen</button>
                                                </a>
                                            </div>
                                        </h5>

                                        @foreach($documents->where('tab_name', 'Unterlagen') as $group)
                                            <h5>{{ $group->name }}</h5>
                                            <div class="table-responsive margin-bottom-50">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Art</th>
                                                        <th>Eingabe, hinzugefÃ¼gt am</th>
                                                        <th>Dokumentname</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Art</th>
                                                        <th>Eingabe, hinzugefÃ¼gt am</th>
                                                        <th>Dokumentname</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    @foreach($group->documents as $doc)
                                                        <tr>
                                                            <td>{{ $doc->document_type->name }}</td>
                                                            <td>@if($doc->updated_by) {{ $doc->updated_by->name }} {{ $doc->updated_by->last_name }} @else {{ $application->applicant->name }} {{ $application->applicant->last_name }} @endif, {{ $doc->updated_at }}</td>
                                                            <td><a href="/storage/{{ $doc->file }}" target="_blank">{{ $doc->name }}</a>, {{ $doc->size_human() }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach

                                        {{--
                                        @if($documents)
                                        <div class="table-responsive margin-bottom-50">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Eingabe, hinzugefÃ¼gt am</th>
                                                        <th>Art</th>
                                                        <th>Letzter Redakteur</th>
                                                        <th>Anzahl</th>
                                                        <th>Dokumentname</th>
                                                        <th>Aktion</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Eingabe, hinzugefÃ¼gt am</th>
                                                        <th>Art</th>
                                                        <th>Letzter Redakteur</th>
                                                        <th>Anzahl</th>
                                                        <th>Dokumentname</th>
                                                        <th>Aktion</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @foreach($documents as $document)
                                                    <tr>
                                                        <td>{{ $document->created_at }}</td>
                                                        <td>{{ $document->document_type->name }}</td>
                                                        <td>@if($document->updated_by) {{ $document->updated_by_user->name }} {{ $document->updated_by_user->last_name }} @else {{ $application->applicant->name }} {{ $application->applicant->last_name }} @endif , {{ $document->updated_at }}</td>
                                                        <td>{{ $document->id }}</td>
                                                        <td><a href="/storage/{{ $document->file }}" target="_blank">{{ $document->name }}</a>, {{ $document->size_human() }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-success-outline">
                                                            <i class="icmn-link" aria-hidden="true"></i>
                                                                Change
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        --}}
                                    </div>
                                    <div class="tab-pane" id="write" role="tabpanel">
                                        <br />
                                        <h5>Besch./Schreiben</h5>
                                    </div>
                                    <div class="tab-pane" id="communication" role="tabpanel">
                                        <br />
                                        <h5>Kommunikation</h5>
                                    </div>
                                    <div class="tab-pane" id="events" role="tabpanel">
                                        <br />
                                        <h5>Termine</h5>
                                    </div>
                                   
                                   <!-- include status tab -->
                                   @include('dashboard.crud.applicants.parts.status')

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- End Profile -->

        </div>

        <!-- Page Scripts -->
        <script>
            $(function() {
                $('.selectpicker').selectpicker();
                $('.dropify').dropify();
                $('.datepicker-only-init').datetimepicker({
                    widgetPositioning: {
                        horizontal: 'left'
                    },
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },
                    format: 'DD.MM.YYYY'
                });

                $('.datepicker-init').datetimepicker({
                    widgetPositioning: {
                        horizontal: 'left'
                    },
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },
                    format: 'DD.MM.YYYY HH:mm'
                });

                $('.select2-tags').select2({
                    tags: true,
                    tokenSeparators: [',', ' ']
                });
                ///////////////////////////////////////////////////////////
                // ADJUSTABLE TEXTAREA
                autosize($('.adjustable-textarea'));

                ///////////////////////////////////////////////////////////
                // MEDIA PLAYER
                if (!(typeof angular === 'undefined')) {
                    $('.mediatec-cleanaudioplayer').cleanaudioplayer();
                    $('.mediatec-cleanvideoplayer').cleanvideoplayer();
                }

                ///////////////////////////////////////////////////////////
                // CALENDAR
                $('.example-calendar-block').fullCalendar({
                    //aspectRatio: 2,
                    height: 450,
                    header: {
                        left: 'prev, next',
                        center: 'title',
                        right: 'month, agendaWeek, agendaDay'
                    },
                    buttonIcons: {
                        prev: 'none fa fa-arrow-left',
                        next: 'none fa fa-arrow-right',
                        prevYear: 'none fa fa-arrow-left',
                        nextYear: 'none fa fa-arrow-right'
                    },
                    Actionable: true,
                    eventLimit: true, // allow "more" link when too many events
                    viewRender: function(view, element) {
                        if (!cleanUI.hasTouch) {
                            $('.fc-scroller').jScrollPane({
                                autoReinitialise: true,
                                autoReinitialiseDelay: 100
                            });
                        }
                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        if (!$(this).hasClass('event-clicked')) {
                            $('.fc-event').removeClass('event-clicked');
                            $(this).addClass('event-clicked');
                        }
                    },
                    defaultDate: '2016-05-12',
                    events: [
                        {
                            title: 'All Day Event',
                            start: '2016-05-01',
                            className: 'fc-event-success'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: '2016-05-09T16:00:00',
                            className: 'fc-event-default'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: '2016-05-16T16:00:00',
                            className: 'fc-event-success'
                        },
                        {
                            title: 'Conference',
                            start: '2016-05-11',
                            end: '2016-05-14',
                            className: 'fc-event-danger'
                        }
                    ]
                });

                ///////////////////////////////////////////////////////////
                // SWAL ALERTS
                $('.swal-btn-success').click(function(e){
                    e.preventDefault();
                    swal({
                        title: "Following",
                        text: "Now you are following Artour Scott",
                        type: "success",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Ok"
                    });
                });

                $('.swal-btn-success-2').click(function(e){
                    e.preventDefault();
                    swal({
                        title: "Friends request",
                        text: "Friends request was succesfully sent to Artour Scott",
                        type: "success",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Ok"
                    });
                });

                $.get({{ $application->id }} + '/contracts/' + $('#document_group').val(), function (data) {
                    $('#document_list').html(data[0]);
                    $('#doc_type').html(data[1]);
                });
                $('#document_group').change(function(e){
                    e.preventDefault();
                    $.get({{ $application->id }} + '/contracts/' + $('#document_group').val(), function (data) {
                        $('#document_list').html(data[0]);
                        $('#doc_type').html(data[1]);
                    });
                });

            });
        </script>
        <!-- End Page Scripts -->
    </section>
@endsection