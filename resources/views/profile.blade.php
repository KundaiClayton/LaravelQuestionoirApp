@extends('template')

@section('content')
<div class="container">
    <h2 class="p-2 mb-3 ">Profile For: {{$user->name}}</h2>
    <h4 class="p-3 mb-3 text-primary">
        {{$user->name}}`s contributions
    </h4>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h3 class="d-flex justify-content-center">Questions</h3>
            @foreach ($user->questions as $question )
                <div class="card m-2">
                    <div class="card-body">
                        <h4>{{$question->title}}</h4>
                        <p>
                            {{$question->description}}
                        </p>
                    </div>
                    <div class="card-footer">
                    <a href="{{route('questions.show',$question->id)}}" class="btn btn-link p-3 d-flex justify-content-center">View Question </a>
                    </div>
                </div>
                
            @endforeach
            
        </div>
        <div class="col-md-6" >
           
            <h3 class="d-flex justify-content-center">Answers</h3>
            @foreach ($user->answers as $answer )
                <div class="card m-2">
                    <div class="card-header">
                        <b>Question:</b>
                        {{$answer->question->title}}
                    </div>
                    <div class="card-body">
                       
                        <p>
                           <p> <b> {{$user->name}}'s' Answer:</b></p>
                            {{$answer->content}}
                        </p>
                    </div>
                    <div class="card-footer">
                    <a href="{{route('questions.show',$answer->question->id)}}" class="btn btn-link p-3 d-flex justify-content-center">View Answer </a>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
</div>
    
@endsection