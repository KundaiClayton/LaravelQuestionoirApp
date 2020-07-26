<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;

class QuestionController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieve a list of records from model
        $questions=Question::orderBy('id','desc')->paginate(5);
        //loop through records and return them
        return view ('questions.index')->with('questions',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form data
        $this->validate($request,[
            'title'=>'required|max:255',
            
        ]);

        //process data and submit
        $question =new Question();
        $question->title=$request->title;
        $question->description=$request->description;
        
        //define user
        $question->user()->associate(Auth::id());
        

        //redirect if successful
        if ($question->save()) {
            //session()->flash('success','Question Posted');
            return redirect()->route('questions.show',$question->id)->with('success','Question created successfully!');
            
        }else{
            // session()->flash('success','Question Posted');
            return redirect()->route('questions.store')->with('warning','question should have a max of 255 charscters!');
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
        //use the model to retrieve a single record
        $question=Question::findOrFail($id);
        //show and pass record to view
        return view('questions.show')->with('question',$question);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=Question::findOrFail($id);
        if ($question->user->id !=Auth::id()) {
            return abort(403);
        }
        return view('questions.edit')->with('question',$question);
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
        $question=Question::findOrFail($id);
        if ($question->user->id !=Auth::id()) {
            return abort(403);
        }
        //update question
        $this->validate($request,[
            'title'=>'required|max:255',
            
        ]);
        $question->title=$request->title;
        $question->description=$request->description;
        
        //define user
        $question->user()->associate(Auth::id());
        //$question->save();
        if ($question->save()) {
            return redirect()->route('questions.show',$question->id)->with('success','Post Updated');
            
        }else{
            return redirect()->route('questions.store')->with('warning','question should have a max of 255 charscters!');
        }
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
