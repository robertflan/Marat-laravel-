<?php

namespace App\Http\Controllers\Dashboard;

use App\Application;
use App\Http\Requests\ApplicationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use Yajra\Datatables\Datatables;

use App\DocumentGroup;
use App\DocumentType;
use App\Document;
use App\contract;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->status) {
            if($request->status == 'active') {
                $candidates = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->whereHas('applicant', function ($query) {
                    $query->where('activated', 1);
                })->get();
            } elseif($request->status == 'deactive') {
                $candidates = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->whereHas('applicant', function ($query) {
                    $query->where('activated', 0);
                })->get();
            } else {
                $candidates = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->where('status', $request->status)->get();
            }
        } else {
            $candidates = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->get();
        }

        return view('dashboard.crud.applicants.index', compact('candidates'));
    }

    /**
     * Return json for datatables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Datatables $datatables)
    {
        $query = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location');

        return $datatables->eloquent($query)
            // ->addColumn('gender', function (Application $application) {
            //     return $application->applicant ? $application->applicant->gender : '';
            // })
            ->addColumn('name', function (Application $application) {
                return $application->applicant ? $application->applicant->gender.' '.$application->applicant->name.' '.$application->applicant->last_name : '';
            })
            // ->filterColumn('name', function($query, $keyword) {
            //     $query->where($sql, ["%{$keyword}%"]);
            // })
            // ->addColumn('last_name', function (Application $application) {
            //     return $application->applicant ? $application->applicant->last_name : '';
            // })
            ->addColumn('job', function (Application $application) {
                return $application->job ? $application->job->name : '';
            })
            ->addColumn('category', function (Application $application) {
                return $application->job ? $application->job->categories[0]->short_name : '';
                // return $application->job ? $application->job->categories->map(function ($category) {
                //     return $category->short_name;
                // })->implode('<br>'); : '';
            })
            ->addColumn('location', function (Application $application) {
                return $application->job ? $application->job->location->name : '';
            })
            ->addColumn('manager', function (Application $application) {
                return $application->manager ? $application->manager->name.' '.$application->manager->last_name : '';
            })
            ->addColumn('manager', function (Application $application) {
                return $application->manager ? $application->manager->name.' '.$application->manager->last_name : '';
            })
            ->addColumn('action', function (Application $application) {
                return '<a href="'.url('/dashboard/applicants/' . $application->id).'">
                                            <button type="button" class="btn btn-success-outline">
                                                <i class="icmn-link" aria-hidden="true"></i>
                                                Akte
                                            </button>
                                        </a>';
            })
            // ->filter(function ($query) {
            //     return $query;
            // }, true)
            ->make(true);
    }

    /**
     * Return json for document list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDocumentList($id, $key)
    {
        $application = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->find($id);

        $documents = DocumentGroup::with('documents.updated_by_user', 'documents', 'documents.document_type')
            ->whereHas('documents', function ($query) use ($application) {
                $query->where('user_id', $application->applicant->id);
            })->get();

        $documentList = '';
        foreach($documents->where('tab_name', 'Vertrage')[$key]->documents as $doc) {
            $documentList .=  '<tr>';
            $documentList .=     '<td>'.$doc->updated_at.'</td>';
            $documentList .=     '<td>'.$doc->name.'</td>';
            $documentList .=     '<td>'.$doc->document_type->name.'</td>';
            $documentList .=     '<td>'.$doc->start_date.'</td>';
            $documentList .=     '<td>'.$doc->end_date.'</td>';
            if ($doc->updated_by) {
                $documentList .= '<td>'.$doc->updated_by_user->name.' '.$doc->updated_by_user->last_name.'</td>';
                $documentList .= '<td>'.$doc->updated_by_user->email.'</td>';
            } else {
                $documentList .= '<td>'.$application->applicant->name.' '.$application->applicant->last_name.'</td>';
                $documentList .= '<td>'.$application->applicant->email.'</td>';
            }
            $documentList .=  '</tr>';
        }

        $documentTypeList = '';
        foreach($documents->where('tab_name', 'Vertrage')[$key]->document_types as $type) {
            $documentTypeList .= '<option value="' . $type->id . '">' . $type->name . '</option>';
        }

        return array($documentList, $documentTypeList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_document(Application $application, Request $request)
    {
        $file = $request->doc_file->storeAs('documents', $request->doc_title.'.'.$request->doc_file->extension(), 'public');

        $document = new Document;
        $document->name = $request->doc_title;
        $document->file = $file;
        $document->size = $request->doc_file->getClientSize();
        if ($request->doc_start_date != null) {
            $document->start_date = substr($request->doc_start_date, 6, 4) . '-' . substr($request->doc_start_date, 3, 2) . '-' . substr($request->doc_start_date, 0, 2);
        }
        if ($request->doc_end_date != null) {
            $document->end_date = substr($request->doc_end_date, 6, 4) . '-' . substr($request->doc_end_date, 3, 2) . '-' . substr($request->doc_end_date, 0, 2);
        }
        $document->user_id = $application->user_id;
        $document->application_id = $application->id;
        $document->document_type_id = $request->doc_type;
        $document->updated_by = Auth::user()->id;

        $document->save();

        $application->updated_at = new \Datetime;
        $application->updated_by = Auth::user()->id;
        $application->save();

        return redirect('/dashboard/applicants/'.$application->id)->with('message', 'Document added!');
    }

    /**
     * Update status of application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_status(Application $application, Request $request)
    {
        $application->status = $request->status;
        $application->contact_at = $request->contact_at;
        $application->interview_at = $request->interview_at;
        $application->comment = $request->comment;
        $application->updated_by = Auth::user()->id;
        $application->save();

        return redirect('/dashboard/applicants/'.$application->id)->with('message', 'Status updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id, $filter=0)
    {
        $application = Application::with('applicant.profile', 'company', 'manager', 'job.questionnaires.questions', 'job.categories', 'job.location')->find($id);

        // $documents = DocumentGroup::with('documents.updated_by_user', 'documents', 'documents.document_type')
        //     ->whereHas('documents', function ($query) use ($application) {
        //         $query->where('user_id', $application->applicant->id);
        //     })->get();

        // dd($documents);
        //$documents = Document::all();
        if($filter == 0){
            $documents = Document::all();
        }
        else{
            $documents = Document::all()->where('document_type_id', $filter);
        }
        $document_types = DocumentType::all();
        //  if($filter != 0) {
        //      $documents->where('document_type_id', 3);
        //  }

        $document_groups = DocumentGroup::with('document_types')->get();

        $doc_count['Unterlagen'] = 0;
        foreach($documents->where('tab_name', 'Unterlagen') as $group) {
            $doc_count['Unterlagen'] += $group->documents->count();
        }

        $doc_count['Vertrage'] = 0;
        foreach($documents->where('tab_name', 'Vertrage') as $group) {
            $doc_count['Vertrage'] += $group->documents->count();
        }


        // if($application->applicant->profile->resume) {
        //   $document_count += 1;
        // }

        // if($application->applicant->profile->testimonials) {
        //   $document_count += 1;
        // }

        // if($application->applicant->profile->other_documents) {
        //   $document_count += 1;
        // }

        // if($application->applicant->profile->qualifications) {
        //   $document_count += sizeof($application->applicant->profile->qualifications);
        // }

        return view('dashboard.crud.applicants.show', compact('application', 'documents', 'document_groups', 'doc_count','document_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = Application::with('applicant', 'applicant.profile', 'company', 'manager', 'job', 'job.categories', 'job.location')->find($id);

        $application->applicant->gender = $request->gender;
        $application->applicant->last_name = $request->last_name;
        $application->applicant->name = $request->name;
        $application->applicant->email = $request->email;
        $application->applicant->save();

        $application->applicant->profile->dob = $request->dob;
        $application->applicant->profile->place_of_birth = $request->place_of_birth;
        $application->applicant->profile->nationality = $request->nationality;

        $application->applicant->profile->country = $request->country;
        $application->applicant->profile->city = $request->city;
        $application->applicant->profile->zip_code = $request->zip_code;
        $application->applicant->profile->street = $request->street;

        $application->applicant->profile->mobile_phone = $request->mobile_phone;
        $application->applicant->profile->url_linked = $request->url_linked;
        $application->applicant->profile->url_other = $request->url_other;

        $application->applicant->profile->qualifications = $request->qualifications;

        if($request->language && $request->language_level) {
            $profile->languages = $request->language;
            $profile->language_levels = $request->language_level;
        }

        $application->applicant->profile->save();

        $application->updated_at = new \Datetime;
        $application->updated_by = Auth::user()->id;
        $application->save();

        return redirect('/dashboard/applicants/'.$id)->with('message', 'Profile updated!');
    }
    public function store_contract(Request $request)
    {
        var_dump($request->art);
        exit();
        $contract = new contract;
        $contract->art = $request->art;
        $contract->title = $request->title;
        $contract->begin = $request->contract_begin;
        $contract->end = $request->contract_end;
        $contract->updated_at = new \Datetime;
        $contract->save();

        return redirect('/dashboard/applicants/')->with('message', 'contract added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
    public function show_document($id)
    {
        $application = Application::with('applicant.profile', 'company', 'manager', 'job.questionnaires.questions', 'job.categories', 'job.location')->find($id);

        // $documents = DocumentGroup::with('documents.updated_by_user', 'documents', 'documents.document_type')
        //     ->whereHas('documents', function ($query) use ($application) {
        //         $query->where('user_id', $application->applicant->id);
        //     })->get();

        // dd($documents);
        $documents = Document::all();
        $document_types = DocumentType::all();
         if($id != 0) {
             $documents->where('document_type_id', $id);
         }

        $document_groups = DocumentGroup::with('document_types')->get();

        return view('dashboard.crud.applicants.index', compact('application', 'documents', 'document_groups', 'doc_count','document_types'));
    }

}