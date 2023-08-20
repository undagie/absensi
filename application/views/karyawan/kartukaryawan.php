<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Karyawan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f9fc;
        }

        .card {
            width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-top: 5px solid #4CAF50;
        }

        img.logo {
            width: 120px;
            margin: 10px 0;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 20px 0;
            color: #2C3E50;
            text-align: center;
        }

        .profile-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        img.profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .info {
            flex: 2;
            padding: 0 20px;
        }

        h2 {
            margin: 0 0 15px 0;
            color: #333;
        }

        p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .gradient {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            padding: 10px;
            border-radius: 15px 15px 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qr-code-container {
            flex: 1;
            display: flex;
            align-items: center;
        }

        @media print {

            body,
            div,
            p,
            h1,
            h2 {
                -webkit-print-color-adjust: exact;
                /* Chrome, Safari */
                color-adjust: exact;
                /* Firefox */
            }
        }
    </style>
    <script src="<?= base_url('assets/js/qrcode.min.js') ?>" type="text/javascript"></script>
</head>

<body>
    <div class="card">
        <div class="gradient">
            <img class="logo" src="<?= base_url('assets/img/LOGO-INDICO.png') ?>" alt="Logo Perusahaan">
            <h1>PT INDICO YOUTH INDONESIA</h1>
        </div>
        <div class="profile-container">
            <img class="profile" src="<?= base_url('assets/img/profil/' . $user->foto) ?>" alt="Foto Karyawan">
            <div class="info">
                <h2><?= $user->nama ?></h2>
                <p>Div. <?= $user->nama_divisi ?></p>
                <p><?= $user->alamat ?></p>
                <p>Email: <?= $user->email ?></p>
                <p>Telp: <?= $user->telp ?></p>
            </div>
            <div class="qr-code-container">
                <div id="qrcode"></div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            const userId = "<?= $user->email ?>";
            new QRCode(document.getElementById("qrcode"), {
                text: "https://indicoyouthindonesia.com/profile/" + userId,
                width: 80,
                height: 80,
            });
            window.print();
        }
    </script>
</body>

</html>