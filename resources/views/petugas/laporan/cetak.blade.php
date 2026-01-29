<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left
        }

        th {
            background: #eee
        }
    </style>
</head>

<body onload="window.print()">

    <h2 align="center">LAPORAN PEMINJAMAN ALAT</h2>
    <p align="center">Dicetak oleh Petugas</p>

    <table>
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
        </tr>

        @foreach($peminjamans as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->alat->nama_alat }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                <td>{{ $p->status }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>