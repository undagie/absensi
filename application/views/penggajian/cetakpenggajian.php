<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Daftar Penggajian</h4>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form action="<?= base_url('penggajian/cetakpenggajian') ?>" method="GET" id="filterForm">
                    <div class="row">
                        <div class="col-md-5">
                            <?php $selectedBulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m'); ?>
                            <select name="bulan" class="form-control">
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?= $i ?>" <?= ($i == $selectedBulan) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $i, 1, 2000)) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <?php $selectedTahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); ?>
                            <select name="tahun" class="form-control">
                                <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--) : ?>
                                    <option value="<?= $i ?>" <?= ($i == $selectedTahun) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                            <button type="button" class="btn btn-primary" id="btnPrint"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </form>

                <!-- Tabel Penggajian -->
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>No</th>
                            <th width="30%">Nama Karyawan</th>
                            <th>Tanggal Penggajian</th>
                            <th>Detail Gaji</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($penggajian as $i => $p) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="<?= base_url('assets/img/profil/' . $p->foto) ?>" alt="Gambar Pengguna" class="img-thumbnail rounded-circle w-50">
                                            </div>
                                            <div class="col-8">
                                                <span class="font-weight-bold"><?= $p->nama ?></span> <br>
                                                <span class="text-muted">Div. <?= $p->nama_divisi ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $p->bulan . '-' . $p->tahun ?></td>
                                    <td>
                                        <address>
                                            Gaji Pokok: Rp <?= number_format($p->gaji_pokok, 0, ',', '.') ?> <br>
                                            Honor Lembur: Rp <?= number_format($p->lembur, 0, ',', '.') ?> <br>
                                            Bonus: Rp <?= number_format($p->bonus, 0, ',', '.') ?> <br>
                                            Potongan: Rp <?= number_format($p->potongan, 0, ',', '.') ?> <br>
                                        </address>
                                    </td>
                                    <td>Rp <?= number_format($p->total_gaji, 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('penggajian/cetak_slip_gaji/' . $p->id_penggajian) ?>" class="btn btn-secondary" target="_blank">
                                            <i class="fa fa-print"></i> Cetak Slip Gaji
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnPrint').addEventListener('click', function() {
        // Mendapatkan value dari dropdown bulan dan tahun
        var bulan = document.querySelector("[name='bulan']").value;
        var tahun = document.querySelector("[name='tahun']").value;

        // Membuat URL baru berdasarkan filter
        var url = "<?= base_url('penggajian/print_report') ?>?bulan=" + bulan + "&tahun=" + tahun;

        // Membuka URL di tab baru
        window.open(url, '_blank');
    });
</script>