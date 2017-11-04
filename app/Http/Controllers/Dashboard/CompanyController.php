<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('dashboard.crud.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.crud.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->description = $request->description;
        if($request->image) {
            $company->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }
        $company->save();

        return redirect('/dashboard/companies')->with('message', 'Successfully created company!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('dashboard.crud.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('dashboard.crud.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->name = $request->name;
        $company->description = $request->description;
        if($request->image) {
            $company->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }
        $company->save();

        return redirect('/dashboard/companies')->with('message', 'Successfully updated company!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect('/dashboard/companies')->with('message', 'Company deleted!');
    }
}
