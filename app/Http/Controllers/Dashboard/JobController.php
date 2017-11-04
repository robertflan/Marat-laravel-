<?php

namespace App\Http\Controllers\Dashboard;

use App\Job;
use App\Http\Requests\JobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Location;
use App\Company;
use App\Tag;
use App\Category;
use App\Questionnaire;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->active == 1) {
            $jobs = Job::with('company', 'manager', 'categories', 'location')->isActive(true)->get();
        } elseif($request->active == 2) {
            $jobs = Job::with('company', 'manager', 'categories', 'location')->isActive(false)->get();
        } else {
            $jobs = Job::with('company', 'manager', 'categories', 'location')->get();
        }

        return view('dashboard.crud.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $categories = Category::all();
        $locations = Location::all();
        $tags = Tag::all();
        $questionnaires = Questionnaire::all();
        $managers = Role::where('slug', 'admin')->with('users')->first();

        return view('dashboard.crud.job.create',  compact('companies', 'categories', 'locations', 'tags', 'managers', 'questionnaires'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $job = new Job;
        $job->company_id = $request->company;
        $job->manager_id = $request->manager;
        $job->location_id = $request->location;
        $job->type = $request->type;
        $job->name = $request->name;
        $job->starts_at = $request->starts_at;
        $job->active = $request->active;

        $job->description = str_replace('}}', ']]', str_replace('{{', '[[', $request->description));
        if($request->image) {
            $job->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }

        $job->slug = $request->slug;
        $job->meta_title = $request->meta_title;
        $job->meta_description = $request->meta_description;
        $job->save();

        $job->categories()->attach($request->categories);
        // $job->locations()->attach($request->locations);

        $job->questionnaires()->attach($request->questionnaires);
        if($request->tags) {
            // holly shit this is bad stuff
            foreach($request->tags as $tag) {
                $tagged = Tag::firstOrCreate(['name' => $tag]);
            }
            $tagz = Tag::whereIn('name', $request->tags)->get();
            $job->tags()->attach($tagz);
        }

        return redirect('/dashboard/jobs/'.$job->id)->with('message', 'Successfully created job post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('dashboard.crud.job.show',  compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::with('categories', 'location', 'tags', 'questionnaires')->find($id);
        $companies = Company::all();
        $categories = Category::all();
        $locations = Location::all();
        $tags = Tag::all();
        $questionnaires = Questionnaire::all();
        $managers = Role::where('slug', 'admin')->with('users')->first();

        return view('dashboard.crud.job.edit', compact('job', 'companies', 'categories', 'questionnaires', 'locations', 'tags', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        $questionnaires = Questionnaire::whereIn('id', $request->questionnaires)->pluck('status');
        if(count($request->questionnaires) !== $questionnaires->unique()->count())
            return back()->withInput()->with('message', 'You can only choose one questionnaire for each status!');
        
        $job->company_id = $request->company;
        $job->manager_id = $request->manager;
        $job->location_id = $request->location;
        $job->type = $request->type;
        $job->name = $request->name;
        $job->starts_at = $request->starts_at;
        if($job->active && !$request->active) {
          $job->active = 0;
          $job->inactive_at = new \Datetime;
        } elseif(!$request->active) {
          $job->active = 0;
        } else {
          $job->active = $request->active;
        }
        $job->description = str_replace('}}', ']]', str_replace('{{', '[[', $request->description));
        if($request->image) {
            $job->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        } else {
            $job->image = null;
        }

        $job->slug = $request->slug;
        $job->meta_title = $request->meta_title;
        $job->meta_description = $request->meta_description;
        $job->save();

        $job->categories()->sync($request->categories);
        //$job->locations()->sync($request->locations);
        $job->questionnaires()->sync($request->questionnaires);

        if($request->tags) {
        // holly shit this is bad stuff
            foreach($request->tags as $tag) {
                $tagged = Tag::firstOrCreate(['name' => $tag]);
            }
            $tagz = Tag::whereIn('name', $request->tags)->get();
            $job->tags()->sync($tagz);
        }
        if($request->active) {
          $redirect_path ='/dashboard/jobs';
        } else {
          $redirect_path = '/dashboard/jobs/'.$job->id.'/edit';
        }

        return redirect($redirect_path)->with('message', 'Successfully updated job post!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->categories()->detach();
        //$job->locations()->detach();
        $job->tags()->detach();
        $job->delete();

        return redirect('/dashboard/jobs')->with('message', 'Job Post deleted!');
    }
}
