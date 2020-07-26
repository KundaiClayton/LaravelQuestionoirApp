@extends('template')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>{{$question->title}}</h1>
                <p class="lead">
                    {{$question->description}}
                </p>
                 <p class="badge badge-pill ">Submitted By:<b> {{$question->user->name}} </b><i>on {{$question->created_at->diffForHumans()}}</i></p>
            </div>
           
        </div>
      
    {{-- if user is authenticated allow to edit --}}
    @if($question->user->id =Auth::id()) 
    <a href="/questions/{{$question->id}}/edit" class="btn btn-primary btn-block">Edit Question</a>
    @endif
        <hr>

        @if ($question->answers->count()>0)
            
            @foreach ($question->answers as $answer)
            <div class="card">
                <div class="card-body bg-light ">
                    <p>
                        {{$answer->content}}
                    </p>
                    <p class="badge  badge-info">Answered By:<b> {{$answer->user->name}} </b><i>on {{$answer->created_at->diffForHumans()}}</i></p>
                    {{-- edit answer --}}
                   
                </div>
                @if($answer->user->id =Auth::id()) 
                    <a href="/answers/{{$answer->id}}/edit" class="btn btn-success">Edit Answer</a>
                    
                    @endif
            </div>
            
            @endforeach

        @else
            <p class="card-body bg-warning "> There are no answers yet,please submit answer if you can</p>
        @endif
       
        <div class="mt-3">
            <form action="{{route('answers.store')}}" method="POST">
                @csrf
                <h4>Submit Your Answer:</h4>
                <textarea class="form-control" name="content" columns="30" rows="6"></textarea>
                <input type="hidden" value="{{$question->id}}" name="question_id">
                <button class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
        
    </div>
@endsection