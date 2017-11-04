<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionnaireRequest;
use App\Http\Controllers\Controller;
use App\Application;
use App\Questionnaire;
use App\Question;
use App\User;
use App\Job;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::with('user')->get();
        return view('dashboard.crud.questionnaire.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questionnaire = new Questionnaire;
        return view('dashboard.crud.questionnaire.create', compact('questionnaire'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionnaireRequest $request)
    {
        $questionnaire = new Questionnaire($request->all());
        $questionnaire->user_id = auth()->user()->id;
        $questionnaire->save();

        $questions = [];
        for ($i=0; $i < count($request->question_titles); $i++) { 
            $questions[] = new Question([
                'question_title' => request('question_titles')[$i],
                'type' => request('types')[$i],
                'options' => explode(',', request('options')[$i])
            ]);
        }

        $questionnaire->questions()->saveMany($questions);

        return back()->with('message', 'The questionnaire has been saved.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions');
        return view('dashboard.crud.questionnaire.edit', compact('questionnaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionnaireRequest $request, Questionnaire $questionnaire)
    {
        $questionnaire->fill($request->all());
        $questionnaire->save();

        $questions = [];
        for ($i=0; $i < count($request->question_titles); $i++) { 
            $questions[] = new Question([
                'question_title' => request('question_titles')[$i],
                'type' => request('types')[$i],
                'options' => explode(',', request('options')[$i])
            ]);
        }

        $questionnaire->questions()->delete();
        $questionnaire->questions()->saveMany($questions);

        return back()->with('message', 'The questionnaire has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        $questionnaire->delete();
        return back()->with('message', 'The questionnaire has been deleted.');
    }

    public function answers(Request $request, Application $application, $questionnaire_id) 
    {
        $application->answers()->updateOrCreate(
        ['questionnaire_id' => $questionnaire_id], [
            'json' => $request->json,
            'user_id' => auth()->user()->id
        ]);
        
        return back()->with('message', 'The questionnaire answers have been saved.');
    }
}
