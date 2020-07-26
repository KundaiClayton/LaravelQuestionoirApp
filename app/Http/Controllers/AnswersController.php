<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Auth;

class AnswersController extends Controller
{
   
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|min:15',
            'question_id'=>'required|integer'
        ]);

        $answer=new Answer();
        $answer->content=$request->content;
        $answer->user()->associate(Auth::id());
        
        $question=Question::findOrFail($request->question_id);
        $question->answers()->save($answer);

        return redirect()->route('questions.show',$question->id);
        if ( $question->answers()->save($answer)) {
            return redirect()->route('questions.show',$question->id)->with('success','answered successfully');
            
        }else{
            return redirect()->route('questions.store')->with('error','answer should have be more longer than 15 characters!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer=Answer::findOrFail($id);
        if ($answer->user->id !=Auth::id()) {
            return abort(403);
        }
        return view('answers.edit')->with('answer',$answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'content'=>'required|min:15',
            'question_id'=>'required|integer'
        ]);

        $answer=Answer::findOrFail($id);
        $answer->content=$request->content;
        $answer->user()->associate(Auth::id());
        
        $question=Question::findOrFail($request->question_id);
        $question->answers()->save($answer);

        return redirect()->route('questions.show',$question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
