<?php

namespace App\Http\Controllers\Dashboard;

use App\DocumentGroup;
use App\Http\Requests\DocumentGroupRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;

class DocumentTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_groups = DocumentGroup::with('document_types')->get();
        
        return view('dashboard.crud.document_template.index', compact('document_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('dashboard.crud.document_group.create',  compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentGroupRequest $request)
    {
        $document_group = new DocumentGroup;
        //$document_group->company_id = $request->company;
      
        $document_group->tab_name = $request->tab_name;
        $document_group->name = $request->name;
        $document_group->save();

        return redirect('/dashboard/document_groups')->with('message', 'Successfully created document group!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentGroup $documentGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentGroup $documentGroup)
    {
        $companies = Company::all();

        return view('dashboard.crud.document_group.edit',  compact('companies', 'documentGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentGroupRequest $request, DocumentGroup $documentGroup)
    {
        //$documentGroup->company_id = $request->company;
        $documentGroup->name = $request->name;
        $documentGroup->tab_name = $request->tab_name;
        $documentGroup->save();

        return redirect('/dashboard/document_groups')->with('message', 'Successfully updated document group!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentGroup $documentGroup)
    {
        $documentGroup->delete();

        return redirect('/dashboard/document_groups')->with('message', 'Document Group deleted!');
    }
}
