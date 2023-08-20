<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absen <?= $karyawan->nama ?> bulan <?= bulan($bulan) . ', ' . $tahun ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <style>
        .header {
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid #e3e3e3;
            margin-bottom: 20px;
        }

        .header img.logo {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 16px;
            color: #666;
        }

        .card-header {
            background-color: #f8f8f8;
        }

        .table th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="logo" src="<?= base_url('assets/img/LOGO-INDICO.png') ?>" alt="Logo Perusahaan">
        <h1>PT INDICO YOUTH INDONESIA</h1>
        <h2>Komplek Sidomulyo Raya III, Jl. Mawar Blok E.7, Kel. Landasan Ulin Timur, Kec. Landasan Ulin, Kota Banjarbaru</h2>
    </div>

    <h3 style="text-align:center; margin-bottom: 25px;">LAPORAN DAFTAR PRESENSI</h3>

    <div class="container mt-2">
        <div class="card">
            <div class="card-header d-flex">
                <div class="float-left">
                    <table class="table table-borderless">
                        <tr>
                            <th class="py-0">Nama</th>
                            <th class="py-0">:</th>
                            <th class="py-0"><?= $karyawan->nama ?></th>
                        </tr>
                        <tr>
                            <th class="py-0">Divisi</th>
                            <th class="py-0">:</th>
                            <th class="py-0"><?= $karyawan->nama_divisi ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-4">Absen Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h5>
                <table class="table table-striped table-bordered">
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
                            <tr <?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'class="bg-dark text-white"' : '' ?> <?= ($absen_harian == '') ? 'class="bg-danger text-white"' : '' ?>>
                                <td><?= ($i + 1) ?></td>
                                <td><?= $h['hari'] . ', ' . $h['tgl'] ?></td>
                                <td><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_masuk'], 'masuk') ?></td>
                                <td><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_pulang'], 'pulang') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>