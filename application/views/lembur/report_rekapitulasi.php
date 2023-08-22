<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi Lembur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 200px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            padding-right: 150px;
        }

        .signature .position {
            margin-bottom: 50px;
            padding-right: 125px;
        }

        .signature .name {
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body onload="window.print();">
    <div class="header">
        <img class="logo" src="<?= base_url('assets/img/LOGO-INDICO.png') ?>" alt="Logo Perusahaan">
        <h1>PT INDICO YOUTH INDONESIA</h1>
        <h2>Komplek Sidomulyo Raya III, Jl. Mawar Blok E.7, Kel. Landasan Ulin Timur, Kec. Landasan Ulin, Kota Banjarbaru</h2>
    </div>

    <h3 style="text-align:center;">LAPORAN REKAPITULASI LEMBUR</h3>

    <?php
    if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        echo "<h4 style='text-align:center;'>Bulan: " . date('F', mktime(0, 0, 0, $bulan, 1)) . " Tahun: $tahun</h4>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Total Honor Lembur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekapitulasi as $rek) : ?>
                <tr>
                    <td><?= $rek->nik; ?></td>
                    <td><?= $rek->nama; ?></td>
                    <td>Rp <?= number_format($rek->total_honor, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="footer">
        <div class="signature">
            <div class="position">Direktur</div>
            <div class="name">Kurniawan Dwi Yulianto</div>
        </div>
    </div>
</body>

</html>