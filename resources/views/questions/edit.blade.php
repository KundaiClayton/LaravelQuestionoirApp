@extends('template')
@section('content')
    <div class="container">
        <h1>Edit a Question</h1>
        <hr/>
    <form action="/questions/{{$question->id}}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">Question:</label>
        <input type="text" value="{{$question->title}}" name="title" id="title" class="form-control"/>

            <label for="description">More Information</label>
            <textarea class="form-control"   id="description" cols="30" rows="8" name="description">{{ $question->description }} </textarea>
            
            <input type="submit" value="Submit Question" class="btn btn-primary" />
        </form>
    </div>

@endsection