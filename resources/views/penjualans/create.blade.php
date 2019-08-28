@extends('layouts.master')
@section('title', 'Buat Penjualan')
@section('content')
    <div class="row">
        {!! Form::open(['url' => 'penjualan/store']) !!}
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('nama_pembeli') ? 'has-error' : '' }}">
                {!! Form::label('nama_pembeli', 'Nama Pembeli') !!}
                {!! Form::text('nama_pembeli', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    {{ $errors->first('nama_pembeli') ?: '' }}
                </span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('email_pembeli') ? 'has-error' : '' }}">
                {!! Form::label('email_pembeli', 'Email Pembeli') !!}
                {!! Form::email('email_pembeli', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    {{ $errors->first('email_pembeli') ?: '' }}
                </span>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('telp_pembeli') ? 'has-error' : '' }}">
                {!! Form::label('telp_pembeli', 'Nomor Telepon Pembeli') !!}
                {!! Form::number('telp_pembeli', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    {{ $errors->first('telp_pembeli') ?: '' }}
                </span>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-12">
            <hr>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('mobil', 'Pilih Mobil') !!}
                {!! Form::select('mobil', [], null, ['class' => 'form-control select-mobil']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::button('Pilih', ['class' => 'btn btn-primary btn-pilih-mobil', 'type' => 'button', 'style' => 'margin-top: 25px']) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table_detail">
                    <thead>
                    <tr>
                        <th>Nama Mobil</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="template hidden">
                        <td>
                            <span class="nama_mobil"></span>
                            {!! Form::hidden('details[%INC%][mobil_id]', null, ['disabled']) !!}
                        </td>
                        <td>
                            {!! Form::number('details[%INC%][jumlah]', null, ['class' => 'form-control input-jumlah', 'disabled', 'min' => 1, 'required']) !!}
                        </td>
                        <td>
                            {!! Form::number('details[%INC%][harga]', null, ['class' => 'form-control input-harga', 'disabled', 'readonly']) !!}
                        </td>
                        <td>
                            {!! Form::number('details[%INC%][subtotal]', null, ['class' => 'form-control input-subtotal', 'disabled', 'readonly']) !!}
                        </td>
                        <td>
                            {!! Form::button('hapus', ['class' => 'btn btn-xs btn-danger btn-delete-row', 'type' => 'button']) !!}
                        </td>
                    </tr>
                    @if(old('details'))
                        @foreach(old('details') as $key => $value)
                            <tr>
                                <td>
                                    <span class="nama_mobil"></span>
                                    {!! Form::hidden('details[' . $key . '][mobil_id]', $value['mobil_id'], []) !!}
                                </td>
                                <td>
                                    {!! Form::number('details[' . $key . '][jumlah]', $value['jumlah'], ['class' => 'form-control input-jumlah', 'min' => 1, 'required']) !!}
                                </td>
                                <td>
                                    {!! Form::number('details[' . $key . '][harga]', $value['harga'], ['class' => 'form-control input-harga', 'readonly']) !!}
                                </td>
                                <td>
                                    {!! Form::number('details[' . $key . '][subtotal]', $value['subtotal'], ['class' => 'form-control input-subtotal', 'readonly']) !!}
                                </td>
                                <td>
                                    {!! Form::button('hapus', ['class' => 'btn btn-xs btn-danger btn-delete-row', 'type' => 'button']) !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12">
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('pluginCss')
{!! Html::style('plugins/select2/select2.min.css') !!}
@endpush
@push('pluginJs')
{!! Html::script('plugins/select2/select2.min.js') !!}
@endpush
@push('js')
{!! Html::script('js/penjualan.js') !!}
<script>
    $(document).ready(function () {
        Penjualan.initForm();
    });
</script>
@endpush