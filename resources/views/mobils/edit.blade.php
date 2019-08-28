@extends('layouts.master')
@section('title', 'Edit Mobil')
@section('content')
    <div class="row">
        {!! Form::model($mobil, ['url' => 'mobil/update/' . $mobil->id]) !!}
        @include('mobils.form')
        {!! Form::close() !!}
    </div>
@endsection