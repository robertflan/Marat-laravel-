<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Mail;

use App\Mail\EmailVerify;

use App\User;
use App\Category;
use App\Location;
use App\Job;
use App\Application;
use App\Profile;
use App\DocumentGroup;
use App\DocumentType;
use App\Document;

class FrontEndController extends Controller
{
    protected $company;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->company = env('APP_COMPANY', 1);
    }

    /**
     * Show career home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::has('jobs')->get();
        $locations = Location::has('jobs')->get();
        $jobs = Job::with('tags', 'categories', 'location')->ofCompany($this->company)->isActive(true)->get();

        $popular_categories = Category::ofCompany($this->company)->popular()->get();

        return view('home', compact('categories', 'locations', 'popular_categories', 'jobs'));
    }

    /**
     * Show job page.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobPage($id)
    {
        if(Auth::user()) {
          if(Auth::user()->hasAccess(['access-admin'])) {
            $job = Job::with('tags', 'categories', 'location', 'manager', 'company')->ofCompany($this->company)->where('id', $id)->first();
          }
        } else {
          $job = Job::with('tags', 'categories', 'location', 'manager', 'company')->ofCompany($this->company)->isActive(true)->where('id', $id)->first();
        }

        return view('job', compact('job'));
    }

    /**
     * Search API call.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_query = explode(" ", trim($request->search_text, ","));

        $jobs = Job::ofCompany($this->company)->isActive(true)
            // ->orWhereHas('tags', function($query) use ($request, $search_query) {
            //     if($request->query) {
            //         //$query->orWhere('name', 'like', '%'.$request->search_text.'%');
            //     }
            // })
            ->whereHas('categories', function($query) use ($request) {
                if($request->category && $request->category !== 'all') {
                    $query->where('id', $request->category);
                }
            })
            ->whereHas('location', function($query) use ($request) {
                if($request->location) {
                    $query->where('id', $request->location);
                }
            })
            // ->orWhere('description', 'like', '%'.$request->search_text.'%')
            // ->orWhere('name', 'like', '%'.$request->search_text.'%')
            ->with('tags', 'categories', 'location')
            ->get();

        return $jobs;
    }

    /**
     * Check email exists API call.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        if($request->email) {
            $user = User::where('email', $request->email)->where('company_id', $this->company)->first();

            if($user) {
                return ['error' => 1, 'message' => 'User with this email exists!'];
            } else {
                return ['error' => 0, 'message' => 'Success!'];
            }
        } else {
            return ['error' => 1, 'message' => 'Something bad happened!'];
        }
    }

    // /**
    //  * Fast category Search API call.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function categorySearch(Request $request)
    // {
    //     return $request->category;
    //     $jobs = Job::ofCompany($this->company)
    //         ->whereHas('categories', function($query) use ($request) {
    //             if($request->category && $request->category !== 'all') {
    //                 $query->where('id', $request->category);
    //             }
    //         })
    //         ->with('tags', 'categories', 'location')
    //         ->get();

    //     return $jobs;
    // }


    public function createApplication($id = '')
    {
        $categories = Category::ofCompany($this->company)->get();
        $locations = Location::all();
        $qualifications = DocumentType::where('document_group_id', 2)->get();

        if($id) {
            $job = Job::with('categories')->findOrFail($id);
        }

        if($user = Auth::user()) {
            $resume = Document::where('user_id', $user->id)->where('document_type_id', 12)->first();
            $testim = Document::where('user_id', $user->id)->where('document_type_id', 13)->first();
            $diplom = Document::where('user_id', $user->id)->where('document_type_id', 14)->first();

            return view('application.create_application', compact('categories', 'locations', 'job', 'qualifications', 'resume', 'testim', 'diplom'));
        }

        return view('application.create_application', compact('categories', 'locations', 'job', 'qualifications'));
    }

    public function showMyProfile()
    {
        $user = User::with('profile', 'applications', 'applications.job')->find(Auth::user()->id);

        return view('my.profile', compact('user'));
    }

    public function editMyProfile()
    {
        $user = User::with('profile', 'applications', 'applications.job')->find(Auth::user()->id);

        return view('my.edit_profile', compact('user'));
    }

    public function updateMyProfile(Request $request)
    {
        $user = Auth::user();

        if($user->profile) {
            $profile = $user->profile;
        } else {
            $profile = new Profile;
        }

        $profile->dob = $request->birthday;
        $profile->place_of_birth = $request->place_of_birth;
        $profile->nationality = $request->nationality;

        if($request->post_image) {
            $profile->image = $request->post_image->storeAs('profile_images', str_random(10).'.'.$request->post_image->extension(), 'public');
        }

        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->zip_code = $request->code;
        $profile->street = $request->street;
        // $profile->house_number = $request->house_number;

        $profile->mobile_phone = $request->mobile_phone;

        $profile->url_linked = $request->url_linked;
        $profile->url_other = $request->url_other;

        if($request->post_resume) {
            $profile->resume = $request->post_resume->storeAs('resumes', str_random(10).'.'.$request->post_resume->extension(), 'public');
        }

        if($request->post_testimonials) {
            $profile->testimonials = $request->post_testimonials->storeAs('testimonials', str_random(10).'.'.$request->post_testimonials->extension(), 'public');
        }

        // if($request->post_documents) {
        //     $documents = [];
        //     foreach($request->post_documents as $key => $document) {
        //         $documents[$key] = $document->storeAs('other_documents', str_random(10).'.'.$document->extension(), 'public');
        //     }
        //     $profile->other_documents = $documents;
        // }

        $profile->save();

        return redirect('/my/profile')->with('status', 'Profil saved');
    }

    public function storeApplication(Request $request)
    {
        if (!Auth::check()) {
            $activation_code = str_random(30);

            $user = new User;
            $user->company_id = $this->company;
            $user->gender = $request->gender;
            $user->last_name = $request->last_name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->activation_code = $activation_code;
            $user->save();

            $user->roles()->attach(3);

            Mail::to($user)->send(new EmailVerify($user));

            $new_user = true;
            Auth::login($user);
            // Auth::attempt(['email' => $user->email, 'password' => $request['password']]);
        } else {
            $user = Auth::user();
            $new_user = false;
        }


        /***
         *** Create profile
         ***/
        if($user->profile) {
            $profile = $user->profile;
        } else {
            $profile = new Profile;
        }
        $profile->dob = $request->birthday;
        $profile->place_of_birth = $request->place_of_birth;
        $profile->nationality = $request->nationality;

        if($request->post_image) {
            $profile->image = $request->post_image->storeAs('profile_images', str_random(10).'.'.$request->post_image->extension(), 'public');
        }

        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->zip_code = $request->code;
        $profile->street = $request->street;
        // $profile->house_number = $request->house_number;

        // $profile->phone = $request->phone;
        $profile->mobile_phone = $request->mobile_phone;

        $profile->url_linked = $request->url_linked;
        $profile->url_other = $request->url_other;

        //$profile->application = $request->application;
        //$profile->skills = $request->skills;
        //$profile->location = $request->location;

        // $profile->letter = $request->letter;

        /***
         *** Qualifications
         ***/
        if($request->qualifications) {
            foreach($request->qualifications as $q) {
                if($q != 'Sprachliche Kenntnisse') {
                    $qas[] = $q;
                }
            }
            if(isset($qas)) {
                $profile->qualifications = $qas;
            }

            if($request->language && $request->language_level) {
                $profile->languages = $request->language;
                $profile->language_levels = $request->language_level;
            }
        }
        /***
         *** Qualifications
         ***/

        // if($request->self_destroy) {
        //     $profile->self_destroy = $request->self_destroy;
        // }

        $profile->save();

        if(!$user->profile) {
            $user->profile_id = $profile->id;
            $user->save();
        }

        /***
         *** Create job application
         ***/

        $application = new Application;
        $application->user_id = $user->id;
        $application->company_id = $this->company;

        if ($request->job_id) {
            $application->job_id = $request->job_id;

            $job = Job::with('categories')->find($request->job_id);
            if($job->manager_id) {
                $application->manager_id = $job->manager_id;
            }
        }

        $application->status = 0;
        $application->rating = 0;

        $application->recommend = $request->recommend;
        $application->source = $request->source;

        $application->save();

        if($request->post_resume) {
            $file = $request->post_resume->storeAs('resumes', str_random(10).'.'.$request->post_resume->extension(), 'public');

            $document = Document::firstOrNew(['user_id' => $user->id, 'document_type_id' => 12]);
            $document->application_id = $application->id;
            $document->file = $file;
            $document->name = $request->post_resume->getClientOriginalName();
            $document->size = $request->post_resume->getClientSize();
            $document->save();
        }

        if($request->post_testimonials) {
            $file = $request->post_testimonials->storeAs('testimonials', str_random(10).'.'.$request->post_testimonials->extension(), 'public');

            $document = Document::firstOrNew(['user_id' => $user->id, 'document_type_id' => 13]);
            $document->application_id = $application->id;
            $document->file = $file;
            $document->name = $request->post_testimonials->getClientOriginalName();
            $document->size = $request->post_testimonials->getClientSize();
            $document->save();
        }

        if($request->diplome) {
            $file = $request->diplome->storeAs('diplome', str_random(10).'.'.$request->diplome->extension(), 'public');

            $document = Document::firstOrNew(['user_id' => $user->id, 'document_type_id' => 14]);
            $document->application_id = $application->id;
            $document->file = $file;
            $document->name = $request->diplome->getClientOriginalName();
            $document->size = $request->diplome->getClientSize();
            $document->save();
        }

        if($request->qualifications) {
            foreach($request->qualifications as $key => $qual) {
                $fnumber = $key+1;
                $fname = 'qual_file_'.$fnumber;
                if($request->{$fname} && $qual !== 'Sprachliche Kenntnisse') {
                    $document_type = DocumentType::where('name', $qual)->first();
                    $file = $request->{$fname}->storeAs('qual_files'.$document_type->id, str_random(10).'.'.$request->{$fname}->extension(), 'public');

                    $document = Document::firstOrNew(['user_id' => $user->id, 'document_type_id' => $document_type->id]);
                    $document->application_id = $application->id;
                    $document->file = $file;
                    $document->name = $request->{$fname}->getClientOriginalName();
                    $document->size = $request->{$fname}->getClientSize();
                    $document->save();
                }
            }
        }

        // if ($request->job_id) {
        //     $document_types = DocumentType::where('category_id', $job->categories[0]->id)->ofCompany($this->company)->get();

        //     foreach($document_types as $document_type) {
        //         $file_name = 'document_'.$document_type->id;
        //         if($request->{$file_name}) {
        //             $file = $request->{$file_name}->storeAs('documents'.$document_type->id, str_random(10).'.'.$request->{$file_name}->extension(), 'public');

        //             $document = Document::firstOrNew(['user_id' => $user->id, 'document_type_id' => $document_type->id]);
        //             $document->application_id = $application->id;
        //             $document->file = $file;
        //             $document->name = $request->{$file_name}->getClientOriginalName();
        //             $document->size = $request->{$file_name}->getClientSize();
        //             $document->save();
        //         }
        //     }
        // }

        if($new_user) {
            return redirect()->back()->with('status', 'Ihre Bewerbung ist erfolgreich eingereicht. Bitte überprüfen Sie Ihre E-Mail und klicken Sie auf Bestätigungslink');
        } else {
            return redirect()->intended('/my/profile');
        }
    }
}
