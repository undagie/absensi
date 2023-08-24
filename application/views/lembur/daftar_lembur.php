<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Daftar Lembur</h4>
                <div class="d-inline ml-auto float-right">
                    <button class="btn btn-info ml-2" id="generateLemburBtn"><i class="fa fa-cogs"></i> Generate Lembur</button>
                </div>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form action="<?= base_url('lembur') ?>" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <?php $selectedBulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m'); ?>
                            <select name="bulan" class="form-control">
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?= $i ?>" <?= ($i == $selectedBulan) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $i, 1, 2000)) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
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

                <!-- Tabel Lembur -->
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>No</th>
                            <th width="30%">Nama Karyawan</th>
                            <th>Tanggal Lembur</th>
                            <th>Jam Lembur</th>
                            <th>Honor Lembur</th>
                        </thead>
                        <tbody>
                            <?php foreach ($lembur as $i => $l) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="<?= base_url('assets/img/profil/' . $l->foto) ?>" alt="Gambar Pengguna" class="img-thumbnail rounded-circle w-50">
                                            </div>
                                            <div class="col-8">
                                                <span class="font-weight-bold"><?= $l->nama ?></span> <br>
                                                <span class="text-muted">Div. <?= $l->nama_divisi ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $l->tanggal ?></td>
                                    <td><?= $l->jam_lembur ?> jam</td>
                                    <td>Rp <?= number_format($l->biaya, 0, ',', '.') ?></td>
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
    document.getElementById('generateLemburBtn').addEventListener('click', function() {
        let bulan = document.querySelector('select[name="bulan"]').value;
        let tahun = document.querySelector('select[name="tahun"]').value;

        swal({
            title: "Apakah Anda yakin?",
            text: "Ini akan meng-generate lembur untuk semua pegawai!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    closeModal: true,
                },
                confirm: {
                    text: "Ya, generate!",
                    value: true,
                    visible: true,
                    closeModal: true
                }
            }
        }).then((value) => {
            if (value) {
                window.location.href = `<?= base_url('lembur/generate_lembur') ?>?bulan=${bulan}&tahun=${tahun}`;
            }
        });
    });
</script>

<script>
    document.getElementById('btnPrint').addEventListener('click', function() {
        // Mendapatkan value dari dropdown bulan dan tahun
        var bulan = document.querySelector("[name='bulan']").value;
        var tahun = document.querySelector("[name='tahun']").value;

        // Membuat URL baru berdasarkan filter
        var url = "<?= base_url('lembur/print_report') ?>?bulan=" + bulan + "&tahun=" + tahun;

        // Membuka URL di tab baru
        window.open(url, '_blank');
    });
</script>