<div class="col-sm-6">
    <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
        {!! Form::label('nama', 'Nama Mobil') !!}
        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
        <span class="help-block">
             {{ $errors->first('nama') ?: '' }}
        </span>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group {{ $errors->has('harga') ? 'has-error' : '' }}">
        {!! Form::label('harga', 'Harga Mobil') !!}
        {!! Form::number('harga', null, ['class' => 'form-control']) !!}
        <span class="help-block">
             {{ $errors->first('harga') ?: '' }}
        </span>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-sm-6">
    <div class="form-group {{ $errors->has('stok') ? 'has-error' : '' }}">
        {!! Form::label('stok', 'Stock Mobil') !!}
        {!! Form::number('stok', null, ['class' => 'form-control']) !!}
        <span class="help-block">
             {{ $errors->first('stok') ?: '' }}
        </span>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-sm-12">
    <div class="form-group">
        {!! Form::submit('Tambah', ['class' => 'btn btn-primary']) !!}
        @if(isset($mobil))
            {!! Form::button('Hapus', ['class' => 'btn btn-danger btn-hapus pull-right', 'data-id' => $mobil->id]) !!}
        @endif
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        $('.btn-hapus').on('click', function () {
            if (!confirm('Anda yakin ingin menghapus mobil ini?')) return false;
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: BASE_URL + '/mobil/delete/' + id,
                    method: 'delete',
                    dataType: 'json',
                    success: function (res) {
                        location.href = res.redirect;
                    },
                    error: function () {
                        alert('Oops.. Something went wrong!!');
                    }
                });
            }
        });
    });
</script>
@endpush