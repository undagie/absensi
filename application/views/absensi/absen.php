<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Presensi Harian</h4>
            </div>
            <div class="card-body">
                <table class="table w-100">
                    <thead>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Presensi Masuk</th>
                        <th>Presensi Pulang</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if (is_weekend()) : ?>
                                <td class="bg-light text-danger" colspan="4">Hari ini libur. Tidak Perlu Mengisi Presensi</td>
                            <?php else : ?>
                                <td><i class="fa fa-3x fa-<?= ($absen < 2) ? "warning text-warning" : "check-circle-o text-success" ?>"></i></td>
                                <td><?= tgl_hari(date('d-m-Y')) ?></td>
                                <td>
                                    <?php if (isset($sudah_absen_masuk) && $sudah_absen_masuk) : ?>
                                        <a href="#" class="btn btn-primary btn-sm btn-fill" disabled>Absen Masuk</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('absensi/absen/masuk') ?>" class="btn btn-primary btn-sm btn-fill">Absen Masuk</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($sudah_absen_masuk) : ?>
                                        <?php if (!isset($sudah_absen_pulang) || !$sudah_absen_pulang) : ?>
                                            <a href="javascript:void(0);" onclick="cekWaktuPulang();" class="btn btn-success btn-sm btn-fill">Absen Pulang</a>
                                        <?php else : ?>
                                            <a href="#" class="btn btn-success btn-sm btn-fill" disabled>Absen Pulang</a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="#" class="btn btn-success btn-sm btn-fill" disabled>Absen Pulang</a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function cekWaktuPulang() {
        const now = new Date();
        const jamSekarang = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), now.getMinutes(), now.getSeconds());

        // Pisahkan jam, menit, dan detik dari $jam_pulang dan buat objek Date baru
        const splitJamPulang = "<?= $jam_pulang ?>".split(":");
        const waktuPulang = new Date(now.getFullYear(), now.getMonth(), now.getDate(), splitJamPulang[0], splitJamPulang[1], splitJamPulang[2]);

        if (jamSekarang < waktuPulang) {
            swal({
                icon: 'warning',
                title: 'Oops...',
                text: 'Belum waktunya Absen Pulang.'
            });
        } else {
            window.location.href = '<?= base_url('absensi/absen/pulang') ?>';
        }
    }
</script>