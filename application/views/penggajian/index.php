<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Daftar Penggajian</h4>
                <div class="d-inline ml-auto float-right">
                    <!-- <a href="<?= base_url('penggajian/create') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Penggajian</a> -->
                    <button class="btn btn-info ml-2" id="generateGajiBtn"><i class="fa fa-cogs"></i> Generate Penggajian</button>
                </div>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form action="<?= base_url('penggajian') ?>" method="GET" class="mb-4">
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
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
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
                                        <a href="<?= base_url('penggajian/edit/' . $p->id_penggajian) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?= base_url('penggajian/destroy/' . $p->id_penggajian) ?>" class="btn btn-danger btn-delete ml-2" onclick="return false"><i class="fa fa-trash"></i> Hapus</a>
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
    document.getElementById('generateGajiBtn').addEventListener('click', function() {
        let bulan = document.querySelector('select[name="bulan"]').value;
        let tahun = document.querySelector('select[name="tahun"]').value;

        swal({
            title: "Apakah Anda yakin?",
            text: "Ini akan meng-generate penggajian untuk semua pegawai!",
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
                window.location.href = `<?= base_url('penggajian/generate_gaji') ?>?bulan=${bulan}&tahun=${tahun}`;
            }
        });
    });
</script>