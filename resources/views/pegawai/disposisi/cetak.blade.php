<!DOCTYPE html>
<html>
<head>
    <title>Cetak Disposisi - {{ $surat->nomor_surat }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>LEMBAR DISPOSISI</h2>
    </div>
    
    <p><strong>Nomor Agenda:</strong> {{ $surat->nomor_agenda }}</p>
    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>

    <table>
        <thead>
            <tr>
                <th>Unit Kerja</th>
                <th>Jabatan</th>
                <th>Pegawai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat->disposisiTujuans as $tujuan)
            <tr>
                <td>{{ $tujuan->unit_kerja }}</td>
                <td>{{ $tujuan->jabatan }}</td>
                <td>{{ $tujuan->pegawai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>