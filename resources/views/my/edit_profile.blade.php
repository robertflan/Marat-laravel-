@extends('layouts.app')
@section('header-section')
<!--header section -->
    	<div class="container-fluid page-title">
			<div class="row blue-banner">
            	<div class="container main-container">
                	<div class="col-lg-3  col-md-3  col-sm-6  col-xs-12 col-md-4 col-sm-6 col-xs-12">
                		<h3 class="white-heading">Edit profile</h3>
                    </div>
                </div>
            </div> 
        </div> 
  	 <!--header section -->
@endsection

@section('content')
    <div class="container-fluid white-bg contact_us">
        <form method="POST" action="{{ route('update_my_profile') }}" name="contact_us" id="form-style-2" enctype="multipart/form-data" v-on:submit.prevent="validateApplication">
        {{ csrf_field() }}
            <div class="row user-information">
            <div class="container main-container">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 14px;padding-bottom: 25px;">
                    <div class="col-lg-2 col-md-2 col-sm-2"></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">                         
                        <p><strong>Mit <span style="color:red">*</span> markierte Felder sind Pflichtfelder.</strong></p>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            <input data-vv-as="Vorname" v-validate="'required'" type="text" name="name" placeholder="Enter your first name" required value="{{ Auth::user()->name }}"/>
                            <span v-show="errors.has('name')" class="help-block"><strong>@{{ errors.first('name') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('last_name') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Nachname <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Nachname" v-validate="'required'" type="text" name="last_name" placeholder="Enter your last name" required value="{{ Auth::user()->last_name }}" />
                            <span v-show="errors.has('last_name')" class="help-block"><strong>@{{ errors.first('last_name') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('email') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>E-Mail-Adresse / Login <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">   
                            <input data-vv-as="E-mail" v-validate="'required|email'" type="email" name="email" placeholder="example@example.com" required @if(Auth::user()) value="{{ Auth::user()->email }}" disabled @endif/>
                            <span v-show="errors.has('email')" class="help-block"><strong>@{{ errors.first('email') }}</strong></span>
                            <p>Die hier angegebene E-Mail-Adresse wird als Korrespondenz-E-Mail und als Login verwendet.</p>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('birthday') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label for="birthday">Geburtsdatum <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="input-group datepicker-only-init col-xs-12" style="padding: 0">   
                                <input data-vv-as="Geburtsdatum" v-validate="'required|date_format:DD.MM.YYYY'" id="birthday" type="text" name="birthday" placeholder="TT.MM.JJJJ" required @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->dob }}" @endif />
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
                            <input type="text" name="place_of_birth" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->place_of_birth }}" @endif placeholder="Hamburg, Deutschland"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label class="default">Nationalität <br><span>(optional)</span></label>
                      </div>
                       <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <select class="form-control select2" name="nationality">
                                <option>Schweizerisch</option>
                                <option selected>Deutsch</option>
                                <option>Österreichisch</option>
                                <option>Afghanisch</option>
                                <option>Ägyptisch</option>
                                <option>Åländisch </option>
                                <option>Albanisch</option>
                                <option>Algerisch</option>
                                <option>Amerikanisch</option>
                                <option>Andorranisch</option>
                                <option>Angolanisch</option>
                                <option>Anguilanisch</option>
                                <option>Antiguanisch</option>
                                <option>Äquatorialguineisch</option>
                                <option>Argentinisch</option>
                                <option>Armenisch</option>
                                <option>Arubisch</option>
                                <option>Aserbaidschanisch</option>
                                <option>Äthiopisch</option>
                                <option>Australisch</option>
                                <option>Bahamaisch</option>
                                <option>Bahrainisch</option>
                                <option>Bangladeschisch</option>
                                <option>Barbadisch</option>
                                <option>Belgisch</option>
                                <option>Belizisch</option>
                                <option>Beninisch</option>
                                <option>Bhutanisch</option>
                                <option>Bolivianisch</option>
                                <option>Bosnisch</option>
                                <option>Botsuanisch</option>
                                <option>Brasilianisch</option>
                                <option>Britisch</option>
                                <option>Bruneiisch</option>
                                <option>Bulgarisch</option>
                                <option>Burkinisch</option>
                                <option>Burundisch</option>
                                <option>Chilenisch</option>
                                <option>Chinesisch</option>
                                <option>Costa-ricanisch</option>
                                <option>Curacaoisch</option>
                                <option>Danish</option>
                                <option>Dominicanisch</option>
                                <option>Dominikanisch</option>
                                <option>Dschibutisch</option>
                                <option>Ecuadorianisch</option>
                                <option>Emiratisch</option>
                                <option>Eritreisch</option>
                                <option>Estnisch</option>
                                <option>Faeroese</option>
                                <option>Fidschianisch</option>
                                <option>Finnisch</option>
                                <option>Französisch</option>
                                <option>Gabunisch</option>
                                <option>Gambisch</option>
                                <option>Georgisch</option>
                                <option>Ghanaisch</option>
                                <option>Grenadisch</option>
                                <option>Griechisch</option>
                                <option>Guatemaltekisch</option>
                                <option>Guianese</option>
                                <option>Guinea-bissauisch</option>
                                <option>Guineisch</option>
                                <option>Guyanisch</option>
                                <option>Haitianisch</option>
                                <option>Honduran</option>
                                <option>Honduranisch</option>
                                <option>Indisch</option>
                                <option>Indonesisch</option>
                                <option>Irakisch</option>
                                <option>Iranisch</option>
                                <option>Irish</option>
                                <option>Isländisch</option>
                                <option>Israelisch</option>
                                <option>Italienisch</option>
                                <option>Ivorisch</option>
                                <option>Jamaikanisch</option>
                                <option>Japanisch</option>
                                <option>Jemenitisch</option>
                                <option>Jordanisch</option>
                                <option>Kambodschanisch</option>
                                <option>Kamerunisch</option>
                                <option>Kanadisch</option>
                                <option>Kap-verdisch</option>
                                <option>Kasachisch</option>
                                <option>Katarisch</option>
                                <option>Kenianisch</option>
                                <option>Kirgisisch</option>
                                <option>Kiribatisch</option>
                                <option>Kolumbianisch</option>
                                <option>Komorisch</option>
                                <option>Kongolesisch</option>
                                <option>Kroatisch</option>
                                <option>Kubanisch</option>
                                <option>Kuwaitisch</option>
                                <option>Laotisch</option>
                                <option>Lesothisch</option>
                                <option>Lettisch</option>
                                <option>Libanesisch</option>
                                <option>Liberianisch</option>
                                <option>Libysch</option>
                                <option>Liechtensteinisch</option>
                                <option>Litauisch</option>
                                <option>Lucianisch</option>
                                <option>Madagassisch</option>
                                <option>Malawisch</option>
                                <option>Malaysisch</option>
                                <option>Maledivisch</option>
                                <option>Malisch</option>
                                <option>Maltesisch</option>
                                <option>Marokkanisch</option>
                                <option>Marshallisch</option>
                                <option>Mauretanisch</option>
                                <option>Mauritisch</option>
                                <option>Mazedonisch</option>
                                <option>Mexikanisch</option>
                                <option>Mikronesisch</option>
                                <option>Moldauisch</option>
                                <option>Monegassisch</option>
                                <option>Mongolisch</option>
                                <option>Montenegrinisch</option>
                                <option>Mosambikanisch</option>
                                <option>Myanmarisch</option>
                                <option>Namibisch</option>
                                <option>Nauruisch</option>
                                <option>Nepalesisch</option>
                                <option>Neuseeländisch</option>
                                <option>Nicaraguanisch</option>
                                <option>Niederländisch</option>
                                <option>Nigerianisch</option>
                                <option>Nigrisch</option>
                                <option>Niueanisch</option>
                                <option>North Korean</option>
                                <option>Norwegisch</option>
                                <option>Of Saint Kitts and Nevis</option>
                                <option>Of the Cook Islands</option>
                                <option>Of Trinidad and Tobago</option>
                                <option>Omanisch</option>
                                <option>Osttimorisch</option>
                                <option>Pakistanisch</option>
                                <option>Palauisch</option>
                                <option>Panamaisch</option>
                                <option>Papua-neuguineisch</option>
                                <option>Paraguayisch</option>
                                <option>Peruanisch</option>
                                <option>Philippinisch</option>
                                <option>Polnisch</option>
                                <option>Portugiesisch</option>
                                <option>Puertoricanisch</option>
                                <option>Ruandisch</option>
                                <option>Rumänisch</option>
                                <option>Russisch</option>
                                <option>Salomonisch</option>
                                <option>Salvadorianisch</option>
                                <option>Sambisch</option>
                                <option>Samoanisch</option>
                                <option>San-marinesisch</option>
                                <option>São-toméisch</option>
                                <option>Saudi-arabisch</option>
                                <option>Schwedisch</option>
                                <option>Senegalesisch</option>
                                <option>Serbisch</option>
                                <option>Seychellisch</option>
                                <option>Sierra-leonisch</option>
                                <option>Simbabwisch</option>
                                <option>Singapurisch</option>
                                <option>Slowakisch</option>
                                <option>Slowenisch</option>
                                <option>Somalisch</option>
                                <option>South Korean</option>
                                <option>Spanisch</option>
                                <option>Sri-lankisch</option>
                                <option>Südafrikanisch</option>
                                <option>Sudanesisch</option>
                                <option>Südgeorgisch</option>
                                <option>Surinamisch</option>
                                <option>Swasiländisch</option>
                                <option>Syrisch</option>
                                <option>Tadschikisch</option>
                                <option>Taiwanese</option>
                                <option>Tansanisch</option>
                                <option>Thailändisch</option>
                                <option>Togoisch</option>
                                <option>Tongaisch</option>
                                <option>Tschadisch</option>
                                <option>Tschechisch</option>
                                <option>Tunesisch</option>
                                <option>Türkisch</option>
                                <option>Turkmenisch</option>
                                <option>Tuvaluisch</option>
                                <option>Ugandisch</option>
                                <option>Ukrainisch</option>
                                <option>Ungarisch</option>
                                <option>Uruguayisch</option>
                                <option>Usbekisch</option>
                                <option>Vanuatuisch</option>
                                <option>Vatikanisch</option>
                                <option>Venezolanisch</option>
                                <option>Vietnamesisch</option>
                                <option>Vincentisch</option>
                                <option>Weißrussisch</option>
                                <option>Westsamoanisch</option>
                                <option>Zentralafrikanisch</option>
                                <option>Zyprisch</option>
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
                            <input data-vv-as="Strasse" v-validate="'required'" type="text" name="street" required @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->street }}" @endif />
                            <span v-show="errors.has('street')" class="help-block"><strong>@{{ errors.first('street') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('code') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>PLZ <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="PLZ" v-validate="'required'" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->zip_code }}" @endif type="text" name="code" required />
                            <span v-show="errors.has('code')" class="help-block"><strong>@{{ errors.first('code') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('city') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ort <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Stadt" v-validate="'required'" type="text" name="city" placeholder="Bsp. Hamburg" required @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->city }}" @endif />
                            <span v-show="errors.has('city')" class="help-block"><strong>@{{ errors.first('city') }}</strong></span>
                        </div>
                    </div>
                    {{--<div class="form-group" :class="{'has-error': errors.has('house_number') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ort <span style="color:red">*</span></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="Ort" v-validate="'required'" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->house_number }}" @endif type="text" name="house_number" required />
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
                            <input data-vv-as="Telefon" v-validate="'required'" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->mobile_phone }}" @endif type="text" name="mobile_phone" required />
                            <span v-show="errors.has('mobile_phone')" class="help-block"><strong>@{{ errors.first('mobile_phone') }}</strong></span>
                            <p>Unter welcher Nummer bin ich tagsüber erreichbar?<br> Bitte gib die Nummer inkl. Ländervorwahl an (z.B. +41 61 999 99 XX)</p>
                        </div>
                    </div>
                </div>
             </div>
        </div>
      
       {{-- <!-- User Data Row-->
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
                        {{--<div v-for="item in application.qualification">
                            <div class="form-group">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  
                                    <label>Qualifikationen</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">   
                                    <select class="form-control" v-model="item.qual" name="qualifications[]">
                                        <option>Erst-Helfer-Bescheinigung (Erst-Hilfe-Kurs)</option>
                                        <option>Sachkundenachweis nach §34a GewO</option>
                                        <option>Unterrichtung nach §34a GewO</option>
                                        <option>Infektionsschutzbelehrung nach § 43 I IfSG</option>
                                        <option>Polizeiliches Führungszeugnis</option>
                                        <option>Waffenschein</option>
                                        <option>Brandhelferbescheinigung</option>
                                        <option>(FSK-Nachweis)</option>
                                        <option>Werkschutzqualifikation</option>
                                        <option>Personenschutzausbildung</option>
                                        <option>Sprachliche Kenntnisse</option>
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
                                <div v-for="langi in application.language">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-xs-12">  
                                                <label>Language</label>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">   
                                                <select class="form-control" v-model="langi.lang" name="language[]">
                                                    <option>English</option>
                                                    <option>German</option>
                                                    <option>French</option>
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
                                                    <option>Fluent</option>
                                                    <option>Advanced</option>
                                                    <option>Basic</option>
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
            </div>--}}

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
                        @if(Auth::user()->profile_id)
                        @if(Auth::user()->profile->resume)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ Auth::user()->profile->resume }}" style="font-size:16px;">View Lebenslauf</a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group file-type " :class="{'has-error': errors.has('post_resume') }">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="default">Lebenslauf <span style="color:red">*</span></label>
                            </div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
                                <input @if(Auth::user()->profile_id) @if(Auth::user()->profile->resume) data-vv-as="Lebenslauf" v-validate="'size:10240'" @endif @else data-vv-as="Lebenslauf" v-validate="'required|size:10240'" required @endif type="file" name="post_resume" class="inputfile" id="select_file" placeholder="" />
                                <div class="upload resume">
                                    <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse resume</div>
                                   <i>Maximal 10 MB.</i>
                                </div>
                                <span v-show="errors.has('post_resume')" class="help-block"><strong>@{{ errors.first('post_resume') }}</strong></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(Auth::user()->profile_id)
                        @if(Auth::user()->profile->testimonials)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ Auth::user()->profile->testimonials }}" style="font-size:16px;">View Motivationsschreiben</a>
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
                        @if(Auth::user()->profile_id)
                        @if(Auth::user()->profile->other_documents)
                        @foreach(Auth::user()->profile->other_documents as $key => $doc)
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12" style="padding-left: 40px;">
                                <a href="/storage/{{ $doc }}" style="font-size:16px;">View datei #{{ $key+1 }}</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endif
                        <div class="form-group file-type ">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="default">Zeugnisse/Diplome <br /><span>(optional)</span></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <input type="file" name="post_documents[]" class="inputfile" id="select_file" placeholder="" multiple/>
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
                            <input data-vv-as="URL" v-validate="'url'" type="text" name="url_linked" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->url_linked }}" @endif  />
                            <span v-show="errors.has('url_linked')" class="help-block"><strong>@{{ errors.first('url_linked') }}</strong></span>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': errors.has('url_other') }">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Weiterer Link</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input data-vv-as="URL" v-validate="'url'" type="text" name="url_other" @if(Auth::user()->profile_id) value="{{ Auth::user()->profile->url_other }}" @endif />
                            <span v-show="errors.has('url_other')" class="help-block"><strong>@{{ errors.first('url_other') }}</strong></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="form-group submit col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center" style="margin-top:15px; margin-bottom:15px; margin-left: auto; margin-right: auto;">
                <button class="black" type="submit">Save</button>
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