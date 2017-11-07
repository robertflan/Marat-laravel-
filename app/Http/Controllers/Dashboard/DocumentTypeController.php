<?php

namespace App\Http\Controllers\Dashboard;

use App\DocumentType;
use App\Http\Requests\DocumentTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DocumentGroup;
use App\Company;
use App\Category;
use App\Document;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_types = DocumentType::with('document_group')->get();
        $documents = Document::all();

        return view('dashboard.crud.document_type.index', compact('document_types','documents'));
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
        $document_groups = DocumentGroup::all();

        return view('dashboard.crud.document_type.create',  compact('companies', 'categories', 'document_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeRequest $request)
    {
        $document_type = new DocumentType;
        //$document_type->company_id = $request->company;
        //$document_type->category_id = $request->category;
        $document_type->document_group_id = $request->document_group;

        // if($request->required) {
        //     $document_type->required = $request->required;
        // } else {
        //     $document_type->required = false;
        // }

        $document_type->name = $request->name;
        $document_type->save();

        return redirect('/dashboard/document_types')->with('message', 'Successfully created document type!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        $companies = Company::all();
        $categories = Category::all();
        $document_groups = DocumentGroup::all();

        return view('dashboard.crud.document_type.edit',  compact('documentType', 'companies', 'categories', 'document_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeRequest $request, DocumentType $documentType)
    {
        // $documentType->company_id = $request->company;
        // $documentType->category_id = $request->category;
        $documentType->document_group_id = $request->document_group;

        // if($request->required) {
        //     $documentType->required = $request->required;
        // } else {
        //     $documentType->required = false;
        // }
        
        $documentType->name = $request->name;
        $documentType->save();

        return redirect('/dashboard/document_types')->with('message', 'Successfully updated document type!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();

        return redirect('/dashboard/document_types')->with('message', 'Document Type deleted!');
    }
}
