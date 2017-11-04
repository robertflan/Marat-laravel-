<?php

namespace App\Http\Controllers\Dashboard;

use App\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::with('company')->get();

        return view('dashboard.crud.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('dashboard.crud.location.create',  compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $location = new Location;
        $location->company_id = $request->company;
        $location->name = $request->name;
        $location->description = $request->description;
        if($request->image) {
            $location->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }

        $location->slug = $request->slug;
        $location->meta_title = $request->meta_title;
        $location->meta_description = $request->meta_description;
        $location->save();

        return redirect('/dashboard/locations')->with('message', 'Successfully created location!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('dashboard.crud.location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $companies = Company::all();

        return view('dashboard.crud.location.edit', compact('location', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $location->company_id = $request->company;
        $location->name = $request->name;
        $location->description = $request->description;
        if($request->image) {
            $location->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }

        $location->slug = $request->slug;
        $location->meta_title = $request->meta_title;
        $location->meta_description = $request->meta_description;
        $location->save();

        return redirect('/dashboard/locations')->with('message', 'Successfully updated location!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect('/dashboard/locations')->with('message', 'Location deleted!');
    }
}
