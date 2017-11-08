<?php

namespace App\Http\Controllers\Dashboard;

use App\DocumentTemplate;
use App\Http\Requests\DocumentTemplateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;
use App\Document;
use App\DocumentType;
use App\DocumentGroup;
class DocumentTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=0)
    {
        $document_groups = DocumentGroup::with('document_types')->get();
        if($id == 0){
            $documents = Document::all();
        }else{
            $documents = Document::all()->where('documentgroup_id',$id);
        };
        $document_types = DocumentType::all();
        
        return view('dashboard.crud.document_template.index', compact('document_groups','documents','document_types'));
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
    public function store(Request $request)
    {   
        // $ff = fopen("/Users/dragonstar/Downloads/a.rtf","a");
        // fclose($ff);
        $file = $request->doc_file->storeAs('documents', $request->doc_title.'.'.$request->doc_file->extension(), 'public');

        $document_template = new DocumentTemplate;
        $document_template->file = $file;
        $document_template->size = $request->doc_file->getClientSize();
        $document_template->name = $request->doc_title;

        $document_type = new DocumentType;
        $document_template->document_type_id = $request->doc_type;
        //$document_template->document_group_id = $request->doc_title_tem;
        $document_template->save();

        return redirect('/dashboard/document_templates')->with('message', 'Successfully created document template!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        //
        $document_groups = DocumentGroup::with('document_types')->get();
        if($id == 0){
            $documents = Document::all();
        }else{
            $documents = Document::all()->where('documentgroup_id',$id);
        };
        $document_types = DocumentType::all();
        
        return view('dashboard.crud.document_template.index', compact('document_groups','documents','document_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentTemplate $documentTemplate)
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
    public function update(DocumentTemplateRequest $request, DocumentGroup $documentGroup)
    {
        //$documentGroup->company_id = $request->company;
        $documentGroup->name = $request->name;
        $documentGroup->tab_name = $request->tab_name;
        $documentGroup->save();

        return redirect('/dashboard/document_templates')->with('message', 'Successfully updated document group!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentGroup  $documentGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentTemplateRequest $documentTemplate)
    {
        $document_template>delete();

        return redirect('/dashboard/document_templates')->with('message', 'Document Group deleted!');
    }
}
