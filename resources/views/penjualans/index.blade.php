@extends('layouts.master')
@section('title', 'List Penjualan')
@section('content')
    <table id="example" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Nama Pembeli</th>
            <th>Email Pembeli</th>
            <th>Nomor Telepon Pembeli</th>
            <th>Detail Pembelian</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection
@push('pluginCss')
{!! Html::style('plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap.min.css') !!}
@endpush
@push('pluginJs')
{!! Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') !!}
{!! Html::script('plugins/datatables/DataTables-1.10.18/js/dataTables.bootstrap.min.js') !!}
@endpush
@push('js')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            serverSide: true,
            ajax: {
                type: 'post'
            },
            columns: [
                { data: 'nama_pembeli' },
                { data: 'email_pembeli' },
                { data: 'telp_pembeli' },
                { data: 'detail_penjualan' }
            ],
            "lengthMenu": [ [2, 5, 10, -1], [2, 5, 10, "All"] ]
        });
    });
</script>
@endpush