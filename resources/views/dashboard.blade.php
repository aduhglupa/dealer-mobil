@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        @if($penjualanHariIni)
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>DATA HARI INI</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mobil paling banyak dijual</td>
                            <td>{{ $penjualanHariIni->nama_mobil }}</td>
                        </tr>
                        <tr>
                            <td>Penjualan hari ini</td>
                            <td>
                                {{ $penjualanHariIni->total_jumlah }}
                                @if($penjualanKemarin)
                                    @php
                                        $html = '(0%)';
                                        if ($penjualanKemarin->total_jumlah > $penjualanHariIni->total_jumlah) {
                                            $selisih = ($penjualanKemarin->total_jumlah - $penjualanHariIni->total_jumlah) / $penjualanKemarin->total_jumlah * 100;
                                            $html = "(-{$selisih}%)";
                                        } else if ($penjualanKemarin->total_jumlah < $penjualanHariIni->total_jumlah) {
                                            $selisih = ($penjualanHariIni->total_jumlah - $penjualanKemarin->total_jumlah) / $penjualanKemarin->total_jumlah * 100;
                                            $html = "(+{$selisih}%)";
                                        }
                                    @endphp
                                    {{ $html }}
                                @else
                                    (+100%)
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total penjualan hari ini</td>
                            <td>
                                Rp.{{ number_format($penjualanHariIni->total_subtotal) }}
                                @if($penjualanKemarin)
                                    @php
                                        $html = '(0%)';
                                        if ($penjualanKemarin->total_subtotal > $penjualanHariIni->total_subtotal) {
                                            $selisih = ($penjualanKemarin->total_subtotal - $penjualanHariIni->total_subtotal) / $penjualanKemarin->total_subtotal * 100;
                                            $html = "(-{$selisih}%)";
                                        } else if ($penjualanKemarin->total_subtotal < $penjualanHariIni->total_subtotal) {
                                            $selisih = ($penjualanHariIni->total_subtotal - $penjualanKemarin->total_subtotal) / $penjualanKemarin->total_subtotal * 100;
                                            $html = "(+{$selisih}%)";
                                        }
                                    @endphp
                                    {{ $html }}
                                @else
                                    (+100%)
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if($penjualanSeminggu)
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>DATA 7 HARI TERAKHIR</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mobil paling banyak dijual</td>
                            <td>{{ $penjualanSeminggu->nama_mobil }}</td>
                        </tr>
                        <tr>
                            <td>Penjualan 7 hari terakhir</td>
                            <td>
                                {{ $penjualanSeminggu->total_jumlah }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total penjualan 7 hari terakhir</td>
                            <td>
                                Rp.{{ number_format($penjualanSeminggu->total_subtotal) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection