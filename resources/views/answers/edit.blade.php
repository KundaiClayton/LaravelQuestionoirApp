@extends('template')
@section('content')
    
    <div class="mt-3">
        <form action="/answers/{{$answer->id}}" method="POST">
            @csrf
            @method('PUT')
            <h4>Edit Your Answer:</h4>
            <textarea class="form-contol" name="content" columns="20" rows="6">{{$answer->content}}</textarea>
            <input type="hidden" value="{{$answer->id}}" name="question_id">
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection