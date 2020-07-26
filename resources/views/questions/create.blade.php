@extends('template')
@section('content')
    <div class="container">
        <h1>Ask a Question</h1>
        <hr/>
        <form action="{{route('questions.store')}}" method="POST">
            @csrf
            <label for="title">Question:</label>
            <input type="text" name="title" id="title" class="form-control"/>

            <label for="description">More Information</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="8"></textarea>
            
            <input type="submit" value="Submit Question" class="btn btn-primary btn-block" />
        </form>
    </div>

@endsection