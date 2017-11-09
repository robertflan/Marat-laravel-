<?php

namespace App\Http\Controllers\Dashboard;

use App\Document;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DocumentGroup;
use App\Company;
use App\Category;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $Document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $Document)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, Document $Document)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        
        $document->delete();
        return redirect('/dashboard/document')->with('message', 'Document Group deleted!');
    }
}
