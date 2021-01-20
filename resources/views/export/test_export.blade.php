@extends('layouts.app')

@section('content')

     {!! Form::open(['method'=>'POST','action'=>'Exporting\UserExportsController@export']) !!}


        <div class="form-group">
            {!! Form::submit('Download Users ',['class'=>'btn btn-primary']) !!}
        </div>



      {!! Form::close() !!}

@endsection
