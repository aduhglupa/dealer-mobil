@extends('layouts.master')
@section('title', 'Tambah Mobil')
@section('content')
    <div class="row">
        {!! Form::open(['url' => 'mobil/store']) !!}
        @include('mobils.form')
        {!! Form::close() !!}
    </div>
@endsection