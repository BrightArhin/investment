@extends('layouts.app')


@section('content')
    <form action="{{route('users.imports')}}" method="post" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
        <input type="file" name="excel_file" id="">
    </div>


        <div class="form-group">
            {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
        </div>

    </form>
@endsection
