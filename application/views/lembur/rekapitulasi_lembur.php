<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Rekapitulasi Honor Lembur</h4>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form action="<?= base_url('lembur/rekaplembur') ?>" method="GET" class="mb-4">
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

                <!-- Tabel Rekapitulasi Honor Lembur -->
                <div class="table-responsive">
                    <table class="table table-striped datatable">
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
        var url = "<?= base_url('lembur/print_rekapitulasi') ?>?bulan=" + bulan + "&tahun=" + tahun;

        // Membuka URL di tab baru
        window.open(url, '_blank');
    });
</script>