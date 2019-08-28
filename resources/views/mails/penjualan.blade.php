<html>
<head>
    <title>Invoice Pembelian</title>
</head>
<body>
<p>Terima kasih Pak/Bu {{ $penjualan->nama_pembeli }}, anda telah membeli mobil dari kami</p>
<p>Berikut rincian Pembelian:</p>
<ul>
@foreach($penjualan->details as $detail)
    <li>{{ $detail->mobil->nama }}: {{ $detail->jumlah }} x Rp.{{ number_format($detail->harga) }} = Rp.{{ number_format($detail->subtotal) }}</li>
@endforeach
</ul>
</body>
</html>