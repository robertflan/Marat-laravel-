@extends('layouts.app')

@section('content')
<div class="container-fluid page-title">
            <div class="row green-banner">
                <div class="container main-container">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3 class="white-heading">{{ $job->name }}</h3>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right" >
                        <div class="favourite"><span>{{ $job->created_at }}</span></div>
                    </div>
                </div>
            </div> 
            
            <div class="row dashboard">
                <div class="container main-container gery-bg">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
                        <div class="seprator ">
                            <div class="no-padding user-image"><img src="/assets/images/job-admin.png" alt=""/></div>
                            <div class="user-tag">{{ $job->company->name }}<span>{{ $job->manager->name }} {{ $job->manager->last_name }}</span></div>
                            <div class="job-status"><span class="label job-type job-partytime">{{ $job->type }}</span></div>
                        </div>
                        <div class="seprator">
                            <div class="user-tag"><label>Beruf<span>@foreach($job->categories as $category)
                                                    {{ $category->name }}
                                                @endforeach</span></label></div>
                        </div>
                        @if(!$job->tags->isEmpty())
                         <div class="seprator">
                         
                            <div class="user-tag"><label>Tags<span>@foreach($job->tags as $tag)
                                                    {{ $tag->name }}
                                                @endforeach</span></label></div>
                        </div>
                        @endif
                         <div class="seprator">
                            <div class="user-tag"><label>Einsatzort<span>{{ $job->location->name }}</span></label></div>
                        </div>
                    </div>
            </div>
            </div>        
        </div>
    <!--Page Title-->
    
    <!-- Job Data -->
        <div class="container-fluid jpd-data white-bg">
            <div class="row">
                <div class="container main-container-job">
                    <div class="col-lg-9 col-md-9 col-sm-8">
                        <div class="post-image">
                            @if($job->image)
                                <img src="/storage/{{ $job->image }}"/>
                            @endif
                        </div>
                        <div class="content">
                            {!! $job->company->description !!}
                            {!! $job->description !!}
                         </div>

                         
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-4 sidebar">
                        <div class="widget w1">
                            <ul>
                                <li>
                                    <a href="{{ url('/application/'.$job->id) }}"><span class="label job-type apply-job">Bewerbung einreichen</span></a>
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <!-- Popup Model-->
                                           <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h3 class="modal-title">Apply For This Job<span>Web Designer at Google inc</span></h3>
                                                    </div>
                                                    <div class="modal-body">
                                                       <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input type="text" name="name"/>
                                                       </div>
                                                       <div class="form-group">
                                                            <label>E-mail</label>
                                                            <input type="email" name="email"/>
                                                       </div>
                                                        <div class="form-group">
                                                            <label>Message</label>
                                                            <textarea></textarea>
                                                       </div>
                                                        <div class="form-group file-type">
                                                            <label>Upload your CV/resume or any other relevant file. </label>
                                                            <div class="upload resume">
                                                            <input type="file" name="post-image" class="inputfile" id="select_file" />
                                                            <div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Browse resume</div>
                                                                <i> Max. file size: 50 MB.</i>
                                                            </div>
                                                            
                                                       </div>   
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#"><span class="label job-type apply-job">Send Aplications</span></a>
                                                        <i>OR</i>
                                                        <a href="#"><span class="label job-type submit-resume">Sumbit resume and apply</span></a>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                     
                                </li>
                                <li><img src="assets/images/widget1image.png" alt=""/></li>
                            </ul>                     
                        </div>
                          <!-- Modal -->
  
                        <div class="widget w2">
                            <div class="subscribe">
                                <form>
                                <h3>Get similar jobs by email</h3>
                                    <div class="form-group">
                                        <input type="email" placeholder="enter your email" name="email"/>
                                        <button type="submit" class="btn btn-print bg-blue">Send me a jobs</button>
                                    </div>
                                </form>
                                <a href="#"><i class="fa fa-print" aria-hidden="true"></i>Print Job</a>
                            </div>
                            
                        </div>
                        
                                            
                    </div>
                </div>
            </div>
        
        </div>
    <!--Job Data-->
    
    <!-- ob Recoended-->
        <div class="container-fluid  job-recom">
            <div class="row">
                <div class="main-container">
                    <div class="col-lg-12 text-center">
                        <h3>Recommended Jobs</h3>
                    
                    </div>
                    <div id="recommended-job" class="owl-carousel owl-template">
                    <!--Recomended job-->
                    <div class="item recom-job 01">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                            
                        </div>
                    </div>
                    <!--Recomended job-->
                        <!--Recomended job-->
                    <div class="item recom-job 02">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                            
                        </div>
                    </div>
                    <!--Recomended job-->
                        <!--Recomended job-->
                    <div class="item recom-job 03">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                            
                        </div>
                    </div>
                    <!--Recomended job-->   
                    <!--Recomended job-->
                    <div class="item recom-job 04">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                            
                        </div>
                    </div>
                    <!--Recomended job-->
                    <!--Recomended job-->
                    <div class="item recom-job 05">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                        </div>
                    </div>
                    <!--Recomended job-->
                      <div class="item recom-job 06">
                        <div class="related_jos">  
                            <h4>Web Designer at Google inc </h4>
                            <span class="label job-type job-partytime">Party Time</span>
                            <p>New Yourk<br />Google INC opening</p>
                            <span class="salary">$30,000 - $45,000 <i class="fa fa-star-o"></i><i class="fa fa-star"></i></span>
                            
                        </div>
                    </div>
                    <!--Recomended job-->
                    </div>
                    
                    
                </div>
            </div>
        </div>
    <!--Job Recoended-->
    
    <!--Blue Secions --> 
    <div class="container-fluid green-banner" style="background:#12cd6a">
                <div class="row">
                    <div class="container main-container v-middle" id="style-2">
                        <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12  ">
                            <h3 class="white-heading">Got a question?<span class="call-us">send us an email or <strong>call us at 1 (800) 555-5555</strong></span></h3>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                            <a href="#" class="btn btn-getstarted bg-red">get started now</a>
                        </div>
                    </div>
                </div>
            </div>
    <!--blue Section -->
@endsection
