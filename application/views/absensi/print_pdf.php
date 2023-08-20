<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Absen <?= $karyawan->nama ?> bulan <?= bulan($bulan) . ', ' . $tahun ?></title>

    <style>
        /* Stylesheet untuk header */
        .header {
            padding: 20px 0;
            text-align: center;
            border-bottom: 2px solid #333;
            margin-bottom: 20px;
        }

        .header img.logo {
            width: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 12px;
            color: #555;
        }

        /* Stylesheet untuk tabel karyawan */
        table.karyawan-table {
            width: 100%;
            margin-bottom: 20px;
        }

        table.karyawan-table th {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #aaa;
        }

        table.karyawan-table td {
            padding: 8px;
        }

        /* Stylesheet untuk tabel absensi */
        table.absensi-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.absensi-table,
        table.absensi-table th,
        table.absensi-table td {
            border: 1px solid #aaa;
        }

        table.absensi-table th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: left;
        }

        table.absensi-table td {
            padding: 8px;
        }

        /* Styles untuk menandai akhir pekan dan absensi yang hilang */
        .weekend {
            background-color: #333;
            color: white;
        }

        .missing {
            background-color: #ff6666;
            color: white;
        }

        /* Judul laporan */
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PT INDICO YOUTH INDONESIA</h1>
        <h2>Komplek Sidomulyo Raya III, Jl. Mawar Blok E.7, Kel. Landasan Ulin Timur, Kec. Landasan Ulin, Kota Banjarbaru</h2>
    </div>

    <h3>LAPORAN DAFTAR PRESENSI</h3>

    <table class="karyawan-table">
        <tr>
            <th width="20%">Nama</th>
            <td>: <?= $karyawan->nama ?></td>
        </tr>
        <tr>
            <th>Divisi</th>
            <td>: <?= $karyawan->nama_divisi ?></td>
        </tr>
    </table>

    <h5>Absen Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h5>
    <table class="absensi-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hari as $i => $h) : ?>
                <?php
                $absen_harian = array_search($h['tgl'], array_column($absen, 'tgl')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tgl'))] : '';
                ?>
                <tr <?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'class="weekend"' : '' ?> <?= ($absen_harian == '') ? 'class="missing"' : '' ?>>
                    <td><?= ($i + 1) ?></td>
                    <td><?= $h['hari'] . ', ' . $h['tgl'] ?></td>
                    <td><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_masuk'], 'masuk') ?></td>
                    <td><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_pulang'], 'pulang') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>