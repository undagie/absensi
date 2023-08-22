<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>PT Indico Youth Indonesia</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="<?= base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/light-bootstrap-dashboard.css?v=2.0.1') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/css/demo.css') ?>" rel="stylesheet" />

    <script>
        var BASEURL = '<?= base_url() ?>';
    </script>
    <?php check_absen_harian() ?>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg" data-color="blue">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?= base_url() ?>" class="simple-text">
                        <img src="<?= base_url('assets/img/LOGO-INDICO.png') ?>" alt="" class="img-fluid">
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white">
                            <h2 class="my-0 text-center"><label id="hours"><?= date('H') ?></label>:<label id="minutes"><?= date('i') ?></label>:<label id="seconds"><?= date('s') ?></label></h2>
                        </a>
                    </li>
                    <li class="nav-item <?= @$_active ?>">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <i class="nc-icon nc-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= @$_active ?>">
                        <a class="nav-link" href="<?= base_url('user') ?>">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                    <?php if (is_level('Manager')) : ?>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('jam') ?>">
                                <i class="nc-icon nc-time-alarm"></i>
                                <p>Jam Kerja</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('divisi') ?>">
                                <i class="nc-icon nc-bag"></i>
                                <p>Divisi</p>
                            </a>
                        </li>
                        <li class="nav-tabs <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('karyawan') ?>">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('absensi') ?>">
                                <i class="nc-icon nc-tag-content"></i>
                                <p>Presensi</p>
                            </a>
                        </li>
                        <li class="nav-tabs <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('penggajian') ?>">
                                <i class="nc-icon nc-money-coins"></i>
                                <p>Penggajian</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('user/cetakkaryawan') ?>">
                                <i class="nc-icon nc-notes"></i>
                                <p>Daftar Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('penggajian/cetakpenggajian') ?>">
                                <i class="nc-icon nc-notes"></i>
                                <p>Daftar Gaji</p>
                            </a>
                        </li>
                        <li class="nav-tabs <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('lembur') ?>">
                                <i class="nc-icon nc-notes"></i>
                                <p>Daftar Lembur</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('absensi/rekapabsensi') ?>">
                                <i class="nc-icon nc-paper-2"></i>
                                <p>Rekap Presensi</p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('lembur/rekaplembur') ?>">
                                <i class="nc-icon nc-credit-card"></i>
                                <p>Rekap Lembur</p>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('absensi/check_absen') ?>">
                                <i class="nc-icon nc-watch-time"></i>
                                <p class="d-inline">
                                    Presensi
                                    <?php if ($this->session->absen_warning == 'true') : ?>
                                        <span class="float-right ml-auto notification p-0 badge badge-danger"><i class="fa fa-exclamation"></i></span>
                                    <?php endif; ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= @$_active ?>">
                            <a class="nav-link" href="<?= base_url('absensi/detail_absensi') ?>">
                                <i class="nc-icon nc-notes"></i>
                                <p>Detail Presensi</p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard/logout') ?>">
                            <span>Log out <i class="nc-icon nc-button-power"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid">
                    <a class="navbar-brand" href="#"> Sistem Informasi Presensi dan Penggajian Karyawan Pada PT Indico Youth Indonesia</a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div id="alert">
                        <?php if (@$this->session->response) : ?>
                            <div class="alert alert-<?= $this->session->response['status'] == 'error' ? 'danger' : $this->session->response['status'] ?> alert-dismissable fade show" role="alert">
                                <button class="close" aria-dismissable="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p><?= $this->session->response['message'] ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?= $content ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center">
                            &copy; 2023 <a href="#">Mila Siti Salamah</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="<?= base_url('assets/js/core/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/core/popper.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/core/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?= base_url('assets/js/plugins/bootstrap-switch.js') ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
<!-- SweetAlert -->
<script src="<?= base_url('assets/js/plugins/sweetalert.min.js') ?>"></script>

<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="<?= base_url('assets/js/light-bootstrap-dashboard.js?v=2.0.1') ?>" type="text/javascript"></script>

<!-- Main Js -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<!-- Custom Script -->
<script>
    var hoursLabel = document.getElementById("hours");
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    setInterval(setTime, 1000);

    function setTime() {
        secondsLabel.innerHTML = pad(Math.floor(new Date().getSeconds()));
        minutesLabel.innerHTML = pad(Math.floor(new Date().getMinutes()));
        hoursLabel.innerHTML = pad(Math.floor(new Date().getHours()));
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }

    <?php if (@$this->session->absen_needed) : ?>
        var absenNeeded = '<?= json_encode($this->session->absen_needed) ?>';
        <?php $this->session->sess_unset('absen_needed') ?>
    <?php endif; ?>
</script>

<script>
    $(document).ready(function() {
        function calculateTotal() {
            const gajiPokok = parseFloat($('#gaji_pokok').val()) || 0;
            const bonus = parseFloat($('#bonus').val()) || 0;
            const potongan = parseFloat($('#potongan').val()) || 0;
            const honor_lembur = parseFloat($('#honor_lembur').val()) || 0;
            $('#total_gaji').val(gajiPokok + bonus + honor_lembur - potongan);
        }

        $('#bonus, #potongan').on('input', calculateTotal);

        $('#id_user').on('change', function() {
            const userId = $(this).val();
            $.ajax({
                url: "<?= base_url('penggajian/get_gaji_pokok_by_user/') ?>" + userId,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        $('#gaji_pokok').val(data.gaji_pokok);
                        // Panggil fungsi calculateTotal untuk meng-update total gaji
                        calculateTotal();
                    } else {
                        console.error("Terjadi kesalahan saat mengambil gaji pokok.");
                    }
                },
                error: function(err) {
                    console.error("Terjadi kesalahan saat mengambil gaji pokok: ", err);
                }
            });
        });

    });
</script>

</html>