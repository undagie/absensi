<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Data Karyawan</h4>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form method="get" action="<?= base_url('user/cetakkaryawan') ?>" id="filterForm">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="divisi">Filter Divisi:</label>
                                <select class="form-control" name="divisi" id="divisi">
                                    <option value="all" <?= $divisi_filter == 'all' ? 'selected' : '' ?>>Semua Divisi</option>
                                    <?php foreach ($divisions as $division) : ?>
                                        <option value="<?= $division->nama_divisi ?>" <?= $divisi_filter == $division->nama_divisi ? 'selected' : '' ?>>
                                            <?= $division->nama_divisi ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> Filter</button>
                                <a href="<?= base_url('user/print_report') ?>" class="btn btn-info" id="btnPrint"><i class="fa fa-print"></i> Cetak</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Akhir Form Filter -->

                <!-- Tabel Data Karyawan -->
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>No</th>
                            <th width="30%">Karyawan</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Aksi</th> <!-- Kolom baru untuk tombol cetak kartu karyawan -->
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $k) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4 pr-1">
                                                <img src="<?= base_url('assets/img/profil/' . $k->foto) ?>" alt="Img Profil" class="img-thumbnail rounded-circle w-50">
                                            </div>
                                            <div class="col-8 pl-1 mt-3">
                                                <span class="font-weight-bold"><?= $k->nama ?></span><br>
                                                <span class="text-muted">Div. <?= $k->nama_divisi ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $k->alamat ?></td>
                                    <td>
                                        <address>
                                            Email: <?= $k->email ?><br>
                                            Telp: <?= $k->telp ?>
                                        </address>
                                    </td>
                                    <!-- Tombol Aksi untuk cetak kartu karyawan -->
                                    <td>
                                        <a href="<?= base_url('user/cetak_kartu_karyawan/' . $k->id_user) ?>" class="btn btn-secondary"><i class="fa fa-id-card"></i> Cetak Kartu Karyawan</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Akhir Tabel Data Karyawan -->

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnPrint = document.getElementById("btnPrint");
        const selectDivisi = document.getElementById("divisi");

        btnPrint.addEventListener("click", function(e) {
            e.preventDefault(); // Mencegah perilaku default tombol

            const selectedDivisi = selectDivisi.value;
            const baseURL = "<?= base_url('user/print_report') ?>";
            const printURL = `${baseURL}?divisi=${selectedDivisi}`;

            // Buka halaman di tab baru
            const printWindow = window.open(printURL, '_blank');
            printWindow.focus();

            // Setelah tab baru selesai loading, tampilkan jendela cetak
            printWindow.onload = function() {
                printWindow.print();
            };
        });
    });
</script>