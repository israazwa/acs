<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Test {{ $pelajaran->nama_pelajaran }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 20px;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #ddd;
            border-radius: 2px;
            overflow: hidden;
        }
        thead {
            background: #f97316; /* orange modern */
            color: #fff;
        }
        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        th:last-child, td:last-child {
            border-right: none;
        }
        th {
            font-weight: 600;
            font-size: 13px;
        }
        tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        tbody tr:hover {
            background: #ffe5d0;
        }
        .status-lulus {
            color: #16a34a; /* hijau */
            font-weight: 600;
        }
        .status-gagal {
            color: #dc2626; /* merah */
            font-weight: 600;
        }
    </style>
</head>
<body>
    <h2>Hasil Test - {{ $pelajaran->nama_pelajaran }}</h2>
    <p style="margin-top:20px; font-size:12px; text-align:right; color:#555;">
    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}
    </p>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Nilai</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilTests as $hasil)
                <tr>
                    <td>{{ $hasil->user->name }}</td>
                    <td>{{ $hasil->user->email }}</td>
                    <td>{{ $hasil->nilai }}</td>
                    <td>
                        @if($hasil->status_kelulusan)
                            <span class="status-lulus">Lulus</span>
                        @else
                            <span class="status-gagal">Tidak Lulus</span>
                        @endif
                    </td>
                    <td>{{ $hasil->created_at->translatedFormat('d F Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
