@extends('layouts.app')
@section('header-section')
    <div class="container-fluid page-title">
		<div class="row blue-banner">
        	<div class="container main-container">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            		<h3 class="white-heading">Bewerbung einreichen</h3>
                </div>
            </div>
        </div> 
    </div>

    @if(isset($job))
    <div class="container-fluid post-job grey-bg">
     	<div class="row">
        	<div class="container main-container">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<label>{{ $job->name }} - Bewerbung</label>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('content')
	<div class="container-fluid white-bg contact_us">
    	<form method="POST" action="{{ route('application/store') }}" name="contact_us" id="form-style-2" enctype="multipart/form-data" v-on:submit.prevent="validateApplication">
    	{{ csrf_field() }}
        @if(isset($job))
        <input type="hidden" name="job_id" value="{{ $job->id }}" />
        @endif
        	<div class="row user-information">
        	<div class="container main-container">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="modal fade" :class="{'in': modal}" id="myModal" role="dialog" style="display: block;background-color: rgba(0, 0, 0, 0.7);" v-if="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" v-on:click.prevent="modal = false">&times;</button>
                                <h3 class="modal-title">Machten Sie Ihre Bewerbung versenden?</h3>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: 14px;">Ihre Bewerbung zwischengespeichert und binnen 14 Tagen gelöscht, falls Sie diese nicht absenden. In dieser Zeit haben Sie weiterhin die Möglichkeit die Bewerbung nachträglich zu ergänzen und zu versenden.</p>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-6">
                                    <a v-on:click.prevent="submitApplication(0)"><span class="label job-type apply-job">Ya</span></a>
                                </div>
                                <div class="col-md-6">
                                    <a v-on:click.prevent="submitApplication(1)"><span class="label job-type submit-resume">Nein</span></a>
                                </div>
                                <input type="hidden" name="self_destroy" v-model="application.self_destroy">
                            </div>
                        </div>
                   </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 14px;padding-bottom: 25px;">
                    <div class="col-lg-2 col-md-2 col-sm-2"></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        @if (Auth::guest())
                        <p><a href="{{ url('/login?redirect_path='.$_SERVER['REQUEST_URI']) }}">Klicke hier, falls du dich schonmal bei uns beworben hast</a></p>
                        @endif
                        <p>Nach der einmaligen Eingabe deiner Daten wird dir automatisch ein Profil erstellt und das System erkennt dich als Benutzer. Bei einer allfälligen weiteren Bewerbung kannst du dich in das Profil einloggen und neu bewerben.</p>
                         
                        <p><strong>Mit <span style="color:red">*</span> markierte Felder sind Pflichtfelder.</strong></p>
                    </div>
                </div>

            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(Auth::user())
                    @if(Auth::user()->profile_id)
                        @if(Auth::user()->profile->image)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                                <img src="/storage/{{ Auth::user()->profile->image }}" style="max-width: 100px; padding-bottom: 20px;padding-left: 15px;">
                            </div>
                        </div>
                        @endif
                    @endif
                    @endif
                    <div class="form-group file-type " :class="{'has-error': errors.has('post_image') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label class="default">Foto <br><span>(optional)</span></label>
                        </div>
                        <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                            <input data-vv-as="Foto" v-validate="'image|size:2048'" type="file" name="post_image" class="inputfile" id="select_file" placeholder="">
                            <div class="upload resume">
                                <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse image</div>    
                            </div>
                            <span v-show="errors.has('post_image')" class="help-block"><strong>@{{ errors.first('post_image') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Anrede <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <label class="radio-i"><input type="radio" name="gender" value="Herr" @if(Auth::user()) @if(Auth::user()->gender == 'Herr') checked @endif @else checked @endif>Herr</label>
                            <label class="radio-i"><input type="radio" name="gender" value="Frau" @if(Auth::user()) @if(Auth::user()->gender == 'Frau') checked @endif @endif>Frau</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('name') }">
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        	<label>Vorname <span style="color:red">*</span></label>
                        </div>
                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        	<input data-vv-as="Vorname" v-validate="'required'" type="text" name="name" placeholder="Enter your first name" required @if(Auth::user()) value="{{ Auth::user()->name }}" disabled @endif/>
                            <span v-show="errors.has('name')" class="help-block"><strong>@{{ errors.first('name') }}</strong></span>
                    	</div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('last_name') }">
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        	<label>Nachname <span style="color:red">*</span></label>
                        </div>
                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        	<input data-vv-as="Nachname" v-validate="'required'" type="text" name="last_name" placeholder="Enter your last name" required @if(Auth::user()) value="{{ Auth::user()->last_name }}" disabled @endif/>
                            <span v-show="errors.has('last_name')" class="help-block"><strong>@{{ errors.first('last_name') }}</strong></span>
                    	</div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('email') }">
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        	<label>E-Mail-Adresse / Login <span style="color:red">*</span></label>
                        </div>
                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">	
                        	<input name="email" required @if(Auth::user()) value="{{ Auth::user()->email }}" disabled @else data-vv-as="E-mail" v-validate="'required|email'" v-on:change="validateEmail" v-model="email" placeholder="example@example.com" @endif />
                            <span v-if="email_error" class="help-block"><strong>Der eingegebene Wert ist bereits im System. E-Adresse/Login</strong></span>
                            <span v-show="errors.has('email')" class="help-block"><strong>@{{ errors.first('email') }}</strong></span>
                            <p>Die hier angegebene E-Mail-Adresse wird als Korrespondenz-E-Mail und als Login verwendet.</p>
                    	</div>
                    </div>
                @if (Auth::guest())
                    <div class="form-group" :class="{'has-error': errors.has('password') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Passwort <span style="color:red">*</span></label>
                        </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Passwort" v-validate="'required|alpha_num|min:8'" id="password" type="password" name="password" required>
                            <span v-show="errors.has('password')" class="help-block"><strong>@{{ errors.first('password') }}</strong></span>
                        </div>
                    </div>
                @endif
                    <div class="form-group" :class="{'has-error': errors.has('birthday') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label for="birthday">Geburtsdatum <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="input-group datepicker-only-init col-xs-12" style="padding: 0">   
                                <input data-vv-as="Geburtsdatum" v-validate="'required|date_format:DD.MM.YYYY'" id="birthday" type="text" name="birthday" placeholder="TT.MM.JJJJ" required @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->dob }}" @endif @endif />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar-o"></i>
                                </span>
                            </div>
                            <p>Datumsformat: TT.MM.JJJJ</p>
                            <span v-show="errors.has('birthday')" class="help-block"><strong>@{{ errors.first('birthday') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        	<label>Geburtsort</label>
                        </div>
                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">	
                        	<input type="text" name="place_of_birth" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->place_of_birth }}" @endif @endif placeholder="Hamburg, Deutschland"/>
                    	</div>
                    </div>
                    <div class="form-group">
                      	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      		<label class="default">Nationalität <br><span>(optional)</span></label>
                      </div>
                       <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <select class="form-control select2" name="nationality">
                                <option selected>{{ config('enums.nationality')[0] }}</option>
                                @for($i = 1; $i < count(config('enums.nationality')); $i++)
                                <option>{{ config('enums.nationality')[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('last_name') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Land <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <select class="form-control select2" name="country">
                                <option selected>Deutschland</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('street') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Strasse <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Strasse" v-validate="'required'" type="text" name="street" required @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->street }}" @endif @endif />
                            <span v-show="errors.has('street')" class="help-block"><strong>@{{ errors.first('street') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('code') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>PLZ <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="PLZ" v-validate="'required'" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->zip_code }}" @endif @endif type="text" name="code" required />
                            <span v-show="errors.has('code')" class="help-block"><strong>@{{ errors.first('code') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('city') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ort <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Stadt" v-validate="'required'" type="text" name="city" placeholder="Bsp. Hamburg" required @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->city }}" @endif @endif />
                            <span v-show="errors.has('city')" class="help-block"><strong>@{{ errors.first('city') }}</strong></span>
                        </div>
                    </div>
                    {{--<div class="form-group" :class="{'has-error': errors.has('house_number') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ort <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Ort" v-validate="'required'" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->house_number }}" @endif @endif type="text" name="house_number" required />
                            <span v-show="errors.has('house_number')" class="help-block"><strong>@{{ errors.first('house_number') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">	
                        	<label class="default">Adress<br /><span>(optional)</span></label>
                    	</div>
                    	<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control select2" name="country">
						        <option selected>Deutschland</option>
                            </select>
                        </div>
                        <div class="col-lg-2  col-md-3  col-sm-6  col-xs-12">	
                        	<input type="text" name="city" placeholder="city"/>
                    	</div>
                    	<div class="col-lg-2  col-md-3  col-sm-6  col-xs-12">	
                        	<input type="text" name="code" placeholder="zip code"/>
                    	</div>
                    	<div class="col-lg-2  col-md-3  col-sm-6  col-xs-12">	
                        	<input type="text" name="street" placeholder="street"/>
                    	</div>
                    	<div class="col-lg-2  col-md-3  col-sm-6  col-xs-12">	
                        	<input type="text" name="house_number" placeholder="house number"/>
                    	</div>
                    </div> --}}
                    {{--<div class="form-group">
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        	<label>Phone number</label>
                        </div>
                    	<div class="col-lg-2 col-md-10 col-sm-10 col-xs-12">	
                        	<input type="tel" name="phone" placeholder="335-244"/>
                    	</div>
             		</div>--}}
                    <div class="form-group" :class="{'has-error': errors.has('mobile_phone') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Telefon <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Telefon" v-validate="'required'" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->mobile_phone }}" @endif @endif type="text" name="mobile_phone" required />
                            <span v-show="errors.has('mobile_phone')" class="help-block"><strong>@{{ errors.first('mobile_phone') }}</strong></span>
                            <p>Unter welcher Nummer bin ich tagsüber erreichbar?<br> Bitte gib die Nummer inkl. Ländervorwahl an (z.B. +41 61 999 99 XX)</p>
                        </div>
                    </div>
			    </div>
             </div>
        </div>

        @php /*
        @if($document_groups)
        @foreach($document_groups as $document_group)
        <div class="row user-information">
            <div class="container main-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @foreach($document_group->document_types as $document_type)

                    @if(Auth::user())
                    @if(Auth::user()->documents()->where('document_type_id', $document_type->id)->first())
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                            <a href="/storage/{{ Auth::user()->documents()->where('document_type_id', $document_type->id)->first()->file }}" style="font-size:16px;">View {{ $document_type->name }}</a>
                        </div>
                    </div>
                    @endif
                    @endif
                    <div class="form-group file-type " :class="{'has-error': errors.has('document_{{$document_type->id}}') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label class="default">{{ $document_type->name }} @if($document_type->required)<span style="color:red">*</span>@endif</label>
                        </div>
                        <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                            <input @if(Auth::user()) @if(Auth::user()->documents()->where('document_type_id', $document_type->id)->first()) data-vv-as="{{ $document_type->name }}" v-validate="'size:10240'" @else data-vv-as="{{ $document_type->name }}" v-validate="'size:10240<?php if($document_type->required) { echo '|required'; } ?>'"  @endif @if($document_type->required && !Auth::user()->documents()->where('document_type_id', $document_type->id)->first()) required @endif @endif type="file" name="document_{{$document_type->id}}" class="inputfile" placeholder="" />
                            <div class="upload resume">
                                <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse {{ $document_type->name }}</div>
                               <i>Maximal 10 MB.</i>
                            </div>
                            <span v-show="errors.has('document_{{$document_type->id}}')" class="help-block"><strong><?php echo '{{' ?> errors.first('document_{{$document_type->id}}') <?php echo '}}' ?></strong></span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>  
        </div>
        @endforeach
        @endif */
        @endphp
      
       <!-- User Data Row-->
        	<div class="row user-information">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                        {{-- <div class="form-group">
                          	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">	
                            	<label>Application</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">	
                                <select class="form-control select2" id="skills" name = "category" multiple>
                                 @foreach($categories as $category)
                        			<option value="{{ $category->name }}">{{ $category->name }}</option>
                    				@endforeach
                                </select>
                           </div>
                         </div>
                         <div class="form-group">
                          	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">	
                            	<label>Skills</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">	
                            	<input type="text" name="skills" placeholder="Enter your skills with a coma"/>
                           </div>
                         </div>
                         <div class="form-group">
                          	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">	
                            	<label>Location</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">	
                                <select class="form-control select2" id="locations" name="location" multiple>
                                @foreach($locations as $location)
                        			<option value="{{ $location->name }}">{{ $location->name }}</option>
                    				@endforeach
                                </select>
                           </div>
                        </div> --}}
                        <div v-for="item in application.qualification">
                            <div class="form-group">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  
                                    <label>Qualifikationen</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">   
                                    <select class="form-control" v-model="item.qual" name="qualifications[]">
                                        <option>Sprachliche Kenntnisse</option>
                                        @foreach($qualifications as $qual)
                                        <option>{{ $qual->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group file-type" v-if="item.qual && item.qual !== 'Sprachliche Kenntnisse'" :class="{'has-error': errors.has('qual_file_'+item.id) }">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="default">@{{ item.qual }}</label>
                                </div>
                                <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                                    <input data-vv-as="File" v-validate="'required'" type="file" id="select_file" :name="'qual_file_'+item.id" class="inputfile" placeholder="">
                                    <div class="upload resume">
                                        <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse file</div>    
                                    </div>
                                    <span v-show="errors.has('qual_file_'+item.id)" class="help-block"><strong>@{{ errors.first('qual_file_'+item.id) }}</strong></span>
                                </div>
                            </div>

                            <div v-if="item.qual && item.qual === 'Sprachliche Kenntnisse'">
                                <div class="row" v-for="langi in application.language">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-xs-12">  
                                                <label>Language</label>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">   
                                                <select class="form-control" v-model="langi.lang" name="language[]">
                                                    @foreach(config('enums.languages') as $lang)
                                                    <option>{{ $lang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  
                                                <label>Level</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">   
                                                <select class="form-control" v-model="langi.level" name="language_level[]">
                                                    <option>Fließend</option>
                                                    <option>Fortgeschritten</option>
                                                    <option>Grundkenntnisse</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-push-2 col-md-push-2 col-sm-push-2 ">
                                               <a v-on:click.prevent="application.language.push({id: application.language.length+1, qual: ''})" class="add_new"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-push-2 col-md-push-2 col-sm-push-2 ">
                               <a v-on:click.prevent="application.qualification.push({id: application.qualification.length+1, qual: ''})" class="add_new"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
            </div>

            <div class="row user-information">
            	<div class="container main-container">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						{{--<div class="form-group">
                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            	<label>Cover letter</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        	 	<textarea class="textarea" name="letter"></textarea>
                        	</div>

                        </div>--}}
                        <div class="clearfix"></div>
                        @if(Auth::user())
                        @if($resume)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ $resume->file }}" style="font-size:16px;">{{ $resume->name }}</a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group file-type " :class="{'has-error': errors.has('post_resume') }">
                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            	<label class="default">Lebenslauf <span style="color:red">*</span></label>
                        	</div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                                <input @if(Auth::user()) @if(Auth::user()->profile_id) @if(Auth::user()->profile->resume) data-vv-as="Lebenslauf" v-validate="'size:10240'" @endif @endif @else data-vv-as="Lebenslauf" v-validate="'required|size:10240'" required @endif type="file" name="post_resume" class="inputfile" id="select_file" placeholder="" />
                                <div class="upload resume">
                                    <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse resume</div>
                                   <i>Maximal 10 MB.</i>
                                </div>
                                <span v-show="errors.has('post_resume')" class="help-block"><strong>@{{ errors.first('post_resume') }}</strong></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(Auth::user())
                        @if($testim)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ $testim->file }}" style="font-size:16px;">{{ $testim->name }}</a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group file-type " :class="{'has-error': errors.has('post_testimonials') }">
                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            	<label class="default">Motivationsschreiben <br /><span>(optional)</span></label>
                        	</div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <input data-vv-as="Motivationsschreiben" v-validate="'size:10240'" type="file" name="post_testimonials" class="inputfile" id="select_file" placeholder=""/>
                                <div class="upload resume">
                                    <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse testimonials</div>
                                   <i style="font-size: 14px;">Ein Motivationsschreiben mit Bezug zur Stelle ist empfehlenswert. Maximal 10 MB.</i>
                                </div>
                                <span v-show="errors.has('post_testimonials')" class="help-block"><strong>@{{ errors.first('post_testimonials') }}</strong></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(Auth::user())
                        @if($diplom)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ $diplom->file }}" style="font-size:16px;">{{ $diplom->name }}</a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group file-type ">
                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            	<label class="default">Zeugnisse/Diplome <br /><span>(optional)</span></label>
                        	</div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <input type="file" name="diplome" class="inputfile" id="select_file" placeholder=""/>
                                <div class="upload resume">
                                    <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse</div>
                                   <i style="font-size: 14px;">Sie können mehrere Dateien auswählen. Maximal 10 MB.</i>
                                </div>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                    <div class="form-group" :class="{'has-error': errors.has('url_linked') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label style="padding: 0;">LinkedIn-, Xing-Profil oder eigene Webseite</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="URL" v-validate="'url'" type="text" name="url_linked" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->url_linked }}" @endif @endif  />
                            <span v-show="errors.has('url_linked')" class="help-block"><strong>@{{ errors.first('url_linked') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('url_other') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Weiterer Link</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="URL" v-validate="'url'" type="text" name="url_other" @if(Auth::user()) @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->url_other }}" @endif @endif />
                            <span v-show="errors.has('url_other')" class="help-block"><strong>@{{ errors.first('url_other') }}</strong></span>
                        </div>
                    </div>
                    @if (Auth::guest())
                    <div class="form-group" :class="{'has-error': errors.has('source') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label style="padding: 0;">Wie bist du auf uns aufmerksam geworden? <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Feld" v-validate="'required'" type="text" name="source" placeholder="bsp. Facebook" required />
                            <span v-show="errors.has('source')" class="help-block"><strong>@{{ errors.first('source') }}</strong></span>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <label style="width:auto;max-width: 1200px;padding-bottom: 5px">Bitte gib hier den Namen an, falls dir die Stelle durch einen Mitarbeitenden empfohlen wurde:</label>
                            <input type="text" name="recommend" />
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('check') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                           <label style="max-width: 600px;width: auto;font-size: 16px;"><strong>Ich bin mit der Datenschutzerklärung einverstanden</strong> <span style="color:red;font-size: 14px;">*</span></label>
                           <input data-vv-as="Acceptance" v-validate="'required'" type="checkbox" name="check" style="width: auto; margin-top: 20px;" required>
                           <span v-show="errors.has('check')" class="help-block"><strong>@{{ errors.first('check') }}</strong></span>
                        </div>
                    </div>
                    </div>
			    </div>
			</div>
            <div class="form-group submit col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center" style="margin-top:15px; margin-bottom:15px; margin-left: auto; margin-right: auto;">
                <button class="black" type="submit">Bewerbung definitiv einreichen</button>
                <a class="white-btn" href="{{ url('/') }}">Abbrechen</a>
                <p v-if="validateErrors" style="color: red;"><strong>Please correct the errors above!</strong></p>
            </div>
	   </form>
	</div>
@endsection

@section('asset_js')
    $('.datepicker-only-init').datetimepicker({
        widgetPositioning: {
            horizontal: 'left'
        },
        format: 'DD.MM.YYYY',
        //locale: 'de',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
@endsection