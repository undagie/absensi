<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
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
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
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
    <hr>

    <table>
        <tr>
            <td>Nama Karyawan</td>
            <td>: <?= $penggajian->nama ?></td>
            <td>Periode</td>
            <td>: <?= bulanIndo($penggajian->bulan) . ' ' . $penggajian->tahun ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <?= $penggajian->nik ?></td>
            <td>Divisi</td>
            <td>: <?= $penggajian->nama_divisi ?></td>
        </tr>
    </table>

    <br>
    <table>
        <tr>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Gaji Pokok</td>
            <td>Rp <?= number_format($penggajian->gaji_pokok, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Honor Lembur</td>
            <td>Rp <?= number_format($penggajian->lembur, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Bonus</td>
            <td>Rp <?= number_format($penggajian->bonus, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Potongan</td>
            <td>Rp <?= number_format($penggajian->potongan, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Total Gaji</th>
            <th>Rp <?= number_format($penggajian->total_gaji, 0, ',', '.') ?></th>
        </tr>
    </table>

    <p style="text-align: left; margin-top: 50px;">Tanggal Cetak: <?= date("d-m-Y") ?></p>

    <div class="footer">
        <div class="signature">
            <div class="position">Direktur</div>
            <div class="name">Kurniawan Dwi Yulianto</div>
        </div>
    </div>
</body>

</html>