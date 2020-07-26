@extends('template')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>  Ask A Question!</h1>
        
            <p>Ask any question you want to know about University!</p>
            <p>
            <a href="{{route('questions.create')}}" class="btn btn-primary btn-lg" role="button">Ask Now</a>
            </p>
            
        </div>
      @yield('content')
    </div>
@endsection 