@extends('layouts.app')

@section('content')
  <h3>Create create</h3>
  {!!Form::open(['action'=>'AlbumsController@store','method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
    {{Form::text('name','',['placeholder'=>'Album Name'])}}
    {{Form::textarea('description','',['placeholder'=>'Album Name'])}}
    {{Form::file('cover_image','',['placeholder'=>'Album Description'])}}
    {{Form::submit('submit')}}
  {!! Form::close() !!}
@endsection
