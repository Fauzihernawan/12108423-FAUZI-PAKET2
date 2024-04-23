<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stroke Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .total-row {
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .p {
            text-align: start;
        }

        .tq {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Struk Pembelian</h1>
    </div>
    <div>
            <p>Nama Pelanggan: {{ $penjualan->pelanggan->nm_pelanggan }}</p>
            <p>Alamat: {{ $penjualan->pelanggan->alamat }}</p>
            <p>No. Telepon: {{ $penjualan->pelanggan->no_telp }}</p>

            <p>Tanggal dan Jam: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d H:i A') }}</p>
        <p>DiBuat Oleh: {{ $user->name }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailPenjualan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nm_produk }}</td>
                    <td>{{ $item->jml_produk }}</td>
                    <td>Rp {{ number_format($item->produk->harga) }}</td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total Harga:</td>
                <td>Rp {{ number_format($totalHarga) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Pembayaran:</td>
                <td>Rp {{ number_format($penjualan->pembayaran) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Kembalian:</td>
                    <td>Rp {{ number_format($penjualan->kembalian) }}</td>
            </tr>
        </tbody>
    </table>
    <h5 class="tq">Terima kasih atas pembeliannya</h5>
</body>

</html>
