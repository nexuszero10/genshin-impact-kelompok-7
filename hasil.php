<?php

require_once 'database/koneksi.php';
session_start();
$id_karakter_pertama = $_POST['id_karakter_pertama'];
$id_karakter_kedua = $_POST['id_karakter_kedua'];

$data['data_karakter_pertama'] = getCharacterWithElement($id_karakter_pertama);
$data['data_karakter_kedua'] = getCharacterWithElement($id_karakter_kedua);

$reaction = getSpesificReaction(
    $data['data_karakter_pertama']['elemental_id'],
    $data['data_karakter_kedua']['elemental_id']
);

if ($reaction) {
    $data['elemental_reaction'] = $reaction['reaction'];

    $data['rekomendasi_weapon'] = getWeaponRecomendation(
        $data['data_karakter_pertama']['elemental_id'],
        $data['data_karakter_kedua']['elemental_id']
    );

    $data['rekomendasi_artifact'] = getArtifactRecomendation(
        $data['data_karakter_pertama']['elemental_id'],
        $data['data_karakter_kedua']['elemental_id']
    );
} else {
    $data['elemental_reaction'] = "Tidak ada reaksi elemental karena karakter punya base elemen yang sama.";
    $data['rekomendasi_weapon'] = "Tidak ada rekomendasi weapon.";
    $data['rekomendasi_artifact'] = "Tidak ada rekomendasi artifact.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Combine    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="image/home/logo.png">
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            background-color: #1b2027;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        #container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #1a1e25;
            margin-bottom: 30px;
            padding-top: 10px;
            border-bottom: 1.5px solid #333;
        }

        #title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 100px;
        }

        #title h1 {
            margin-left: 20px;
            font-size: 32.5px;
            color: #ffd700;
            letter-spacing: 7.5px;
            word-spacing: 10px;
        }

        #title img {
            max-width: 130px;
            height: auto;
        }

        nav ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
            gap: 10px;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        nav li {
            font-size: 18px;
            background-color: #393E46;
            color: #ffd700;
            padding: 10px 15px;
            border-radius: 30px;
            white-space: nowrap;
        }

        a {
            color: #ffd700;
            text-decoration: none;
        }

        nav li:hover {
            background-color: #ffd700;
            color: #1b2027;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav li:hover a {
            color: #1b2027;
        }

        #resultContainer * {
            margin: 0;
            padding: 0;
        }

        #resultContainer {
            display: flex;
            flex-direction: column;
            padding: 20px;
            width: 60%;
            margin: 0 auto;
            gap: 15px;
            flex-grow: 1;
            margin-top: 20px;
        }

        #infoKarakter {
            display: flex;
            flex-direction: row;
            padding: 5px;
            border-radius: 8px;
            gap: 5px;
        }

        #karakter-pertama,
        #karakter-kedua {
            display: flex;
            flex: 1;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            gap: 10px;
        }

        #karakter-pertama img,
        #karakter-kedua img {
            width: 50%;
            max-height: 300px;
            border-radius: 20px;
        }

        #hasilReaksi {
            display: flex;
            flex-direction: column;
            padding: 10px;
            border-radius: 8px;
            align-items: center;
            font-size: 20px;
        }

        #rekomendasi {
            display: flex;
            flex-direction: row;
            padding: 5px;
            border-radius: 8px;
            gap: 5px;
        }

        #weapon,
        #artifact {
            display: flex;
            flex: 1;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            gap: 10px;
        }

        #weapon img,
        #artifact img {
            width: 50%;
            max-height: 300px;
            border-radius: 20px;
        }

        footer {
            width: 100%;
            background-color: #1a1d23;
            color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            border-top: 1.5px solid #333;
            margin-top: auto;
        }

        footer .copyright {
            margin-top: 10px;
            font-size: 17.5px;
            color: #ccc;
        }
    </style>
</head>

<body>
    <div id="container">
        <header>
            <div id="title">
                <a href="index.php">
                    <h1>GENSHIN SIMULATION</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="simulasi.php">Simulate</a></li>
                    <li><a href="detail.php">Detail</a></li>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <div id="resultContainer">
            <div id="infoKarakter">
                <div id="karakter-pertama">
                        <img src="image/karakter/card/<?= isset($data['data_karakter_pertama']['karakter_image']) ? $data['data_karakter_pertama']['karakter_image'] : 'default.png' ?>" alt="karakter1">
                    <p>
                        <?= isset($data['data_karakter_pertama']['nama_karakter']) ? $data['data_karakter_pertama']['nama_karakter'] : 'Data tidak tersedia' ?>
                        -
                        <?= isset($data['data_karakter_pertama']['elemental_name']) ? $data['data_karakter_pertama']['elemental_name'] : 'Data tidak tersedia' ?>
                    </p>
                </div>
                <div id="karakter-kedua">
                    <img src="image/karakter/card/<?= isset($data['data_karakter_kedua']['karakter_image']) ? $data['data_karakter_kedua']['karakter_image'] : 'default.png' ?>" alt="karakter2">
                    <p>
                        <?= isset($data['data_karakter_kedua']['nama_karakter']) ? $data['data_karakter_kedua']['nama_karakter'] : 'Data tidak tersedia' ?>
                        -
                        <?= isset($data['data_karakter_kedua']['elemental_name']) ? $data['data_karakter_kedua']['elemental_name'] : 'Data tidak tersedia' ?>
                    </p>
                </div>
            </div>

            <div id="hasilReaksi">
                <p>Elemental Reaction</p>
                <p><?= isset($reaction['reaction']) ? $reaction['reaction'] : 'Tidak ada reaksi elemental' ?></p>
            </div>

            <div id="rekomendasi">
                <div id="weapon">
                    <img src="image/weapon/<?= isset($data['rekomendasi_weapon']['image']) ? $data['rekomendasi_weapon']['image'] : 'default.png' ?>" alt="weapon">
                    <h2><?= isset($data['rekomendasi_weapon']['weapon_name']) ? $data['rekomendasi_weapon']['weapon_name'] : 'Tidak ada rekomendasi weapon' ?></h2>
                    <p><?= isset($data['rekomendasi_weapon']['deskripsi_efek_weapon']) ? $data['rekomendasi_weapon']['deskripsi_efek_weapon'] : 'Tidak ada deskripsi' ?></p>
                </div>
                <div id="artifact">
                    <img src="image/artifact/<?= isset($data['rekomendasi_artifact']['image']) ? $data['rekomendasi_artifact']['image'] : 'default.png' ?>" alt="weapon">
                    <h2><?= isset($data['rekomendasi_artifact']['artifact_name']) ? $data['rekomendasi_artifact']['artifact_name'] : 'Tidak ada rekomendasi artifact' ?></h2>
                    <p><?= isset($data['rekomendasi_artifact']['deskripsi_efek_artifact']) ? $data['rekomendasi_artifact']['deskripsi_efek_artifact'] : 'Tidak ada deskripsi' ?></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="optionalPage">
        </div>
        <div class="copyright">&copy; 2024 Genshin Impact Simulator. All rights reserved.</div>
    </footer>
</body>

</html>