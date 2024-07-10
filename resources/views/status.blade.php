<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rangking</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .header {
            padding: 20px;
            text-align: center;
            background-color: #343a40;
            color: white;
            border-bottom: 2px solid #212529;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 20px;
        }

        .content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            font-size: 18px;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #343a40;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Cop Surat</h1>
        <p>{{ $isKab ? 'Kabupaten' : 'Provinsi' }}: {{ $isKab ? $kab->name ?? '' : $prov->name ?? '' }}</p>
        <p>Periode: {{ $periode->name ?? '' }}</p>
    </div>
    <div class="content">
        <h2 style="text-align: center; font-size: 28px; margin-bottom: 20px;">Laporan Rangking</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <!-- Add other columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>
                            @if ($isKab)
                                @if ($item->status_kabupaten == true)
                                    Lolos
                                @elseif ($item->status == 'gugur-seleksi-kabupaten')
                                    Tidak Lolos
                                @else
                                    Proses
                                @endif
                            @else
                                @if ($item->status == 'lolos-seleksi-provinsi')
                                    Lolos
                                @elseif ($item->status == 'gugur-seleksi-provinsi')
                                    Tidak Lolos
                                @else
                                    Proses
                                @endif
                            @endif

                        </td>
                        <!-- Add other columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
