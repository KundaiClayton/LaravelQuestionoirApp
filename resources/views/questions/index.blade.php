@extends('template')
@section('content')

    <div class="container ">
        <h1>Recent Questions</h1>
        <hr>
       
            @foreach ($questions as $question)
                <div class="card card-body bg-light mb-3" style="background-color: rgb(204, 120, 120); border-color: rgb(151, 146, 146);">
                    <h3 class="card-block">{{$question->title}}</h3>
                    <p class="card-text">
                        {{$question->description}}
                    </p>
                    <a href="{{route('questions.show',$question->id)}}" class="btn btn-primary btn-sm">View Details</a>
                   
                </div>
            @endforeach

            {{$questions->links('vendor.pagination.bootstrap-4')}}
   
    </div>
    
@endsection