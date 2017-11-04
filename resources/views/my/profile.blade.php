@extends('layouts.app')
@section('header-section')
    <div class="container-fluid page-title dashboard">
        <div class="row blue-banner">
            <div class="container main-container">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3 class="white-heading">Mein Profil</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <!-- <div class="favourite short">Save resume<i class="fa fa-star-o"></i></div> -->
                </div>
            </div>
        </div> 
        
        <div class="row dashboard">
            <div class="container main-container gery-bg">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                    <div class="seprator">
                        <div class="no-padding user-image">
                        @if($user->profile && isset($user->profile->image))
                            <img src="/storage/{{ $user->profile->image }}" style="width:53px" />
                        @else
                            <img src="/assets/images/job-admin.png"/>
                        @endif
                        </div>
                        <div class="user-tag">{{ $user->gender }}<span>{{ $user->name }} {{ $user->last_name }}</span></div>
                        @if($user->profile && isset($user->profile->dob))<div class="jos-status"><span class="label job-type job-partytime">{{ $user->profile->age() }} Jahre Alt</span></div>@endif
                    </div>
                    @if($user->profile && isset($user->profile->nationality))
                    <div class="seprator">
                        <div class="user-tag"><label>Nationalität<span>{{ $user->profile->nationality }}</span></label></div>
                    </div>
                    @endif
                    @if($user->profile && isset($user->profile->city))
                    <div class="seprator">
                        <div class="user-tag"><label>Adresse<span>{{ $user->profile->city }}, {{ $user->profile->country }}</span></label></div>
                    </div>
                    @endif
                    @if($user->profile && isset($user->profile->mobile_phone))
                    <div class="seprator">
                        <div class="user-tag"><label>Telefon<span>{{ $user->profile->mobile_phone }}</span></label></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>        
    </div>
@endsection

@section('content')
    <div class="container-fluid white-bg">
        <div class="row">
            <div class="container main-container-job">
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <h3 class="small-heading">Details:</h3>
                        <div class="form-group submit user-info">
                            <ul class="order-table">
                                <li class="table-header">
                                    <ul>
                                        <li><strong>E-Mail-Adresse:</strong></li>
                                        <li>{{ $user->email }}</li>
                                    </ul>
                                </li>
                                @if($user->profile && isset($user->profile->dob))
                                <li class="">
                                    <ul>
                                        <li><strong>Geburtsdatum:</strong></li>
                                        <li>{{ $user->profile->dob }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->place_of_birth))
                                <li class="">
                                    <ul>
                                        <li><strong>Geburtsort:</strong></li>
                                        <li>{{ $user->profile->place_of_birth }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->nationality))
                                <li class="">
                                    <ul>
                                        <li><strong>Nationalität:</strong></li>
                                        <li>{{ $user->profile->nationality }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->phone))
                                <li class="">
                                    <ul>
                                        <li><strong>Telefon land:</strong></li>
                                        <li>{{ $user->profile->phone }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->mobile_phone))
                                <li class="">
                                    <ul>
                                        <li><strong>Telefon:</strong></li>
                                        <li>{{ $user->profile->mobile_phone }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->country))
                                <li class="">
                                    <ul>
                                        <li><strong>Land:</strong></li>
                                        <li>{{ $user->profile->country }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->city))
                                <li class="">
                                    <ul>
                                        <li><strong>Stadt:</strong></li>
                                        <li>{{ $user->profile->city }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->zip_code))
                                <li class="">
                                    <ul>
                                        <li><strong>PLZ:</strong></li>
                                        <li>{{ $user->profile->zip_code }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->street))
                                <li class="">
                                    <ul>
                                        <li><strong>Strasse:</strong></li>
                                        <li>{{ $user->profile->street }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->house_number))
                                <li class="">
                                    <ul>
                                        <li><strong>Ort:</strong></li>
                                        <li>{{ $user->profile->house_number }}</li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->url_linked))
                                <li class="">
                                    <ul>
                                        <li><strong>LinkedIn-, Xing-Profil oder eigene Webseite:</strong></li>
                                        <li><a href="{{ $user->profile->url_linked }}">{{ $user->profile->url_linked }}</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if($user->profile && isset($user->profile->url_other))
                                <li class="">
                                    <ul>
                                        <li><strong>Weiterer Link:</strong></li>
                                        <li><a href="{{ $user->profile->url_other }}">{{ $user->profile->url_other }}</a></li>
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    @if($user->profile && isset($user->profile->languages) && isset($user->profile->language_levels))
                    <div class="">
                        <h3 class="small-heading">Korrespondenzsprache:</h3>
                        <ul class="skills">
                        @foreach($user->profile->languages as $key => $lang)
                            <li>{{ $lang }} - {{ $user->profile->language_levels[$key] }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="content">
                    @if(!$user->applications->isEmpty())
                        <h3 class="small-heading">Active Bewerbungen</h3>
                        <ul class="education">
                        @foreach($user->applications as $ap)
                        <li>
                            <div class="data-row">
                                <div class="date">{{ $ap->created_at }}</div>
                            @if($ap->job_id)
                                <h3>{{ $ap->job->name }}</h3>
                            @else
                                <h3>General application (not attached to job)</h3>
                            @endif
                            </div>
                        </li>
                        @endforeach
                        </ul>
                    @endif
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar">
                    <div class="widget w1">
                        <ul>
                            <li>
                                <a href="/my/profile/edit"><span class="label job-type apply-job">Profil bearbeiten</span></a>
                            </li>
                            <li>
                                <a href="{{ url('/my/change_password') }}"><span class="label job-type apply-job">Passwort setzen</span></a>
                            </li>
                        </ul>                    
                    </div>               
                </div>
            </div>
        </div>
    </div>
@endsection

@section('asset_js')

@endsection