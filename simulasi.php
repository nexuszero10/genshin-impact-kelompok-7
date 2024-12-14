<?php
require_once 'database/koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Elamantal</title>
    <link rel="icon" href="image/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
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

        #pilihKarakter {
            display: flex;
            flex-direction: row;
            padding: 5px;
            width: 100%;
            margin: 0 auto;
            border-radius: 25px;
            gap: 5px;
            box-sizing: border-box;
        }

        #infoList {
            display: flex;
            flex-direction: column;
            padding: 5px;
            margin: 0 auto;
            border-radius: 25px;
            gap: 5px;
            box-sizing: border-box;
        }

        .sub-List {
            display: flex;
            flex-direction: row;
            justify-content: center;
            padding: 5px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .infoContent {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #222831;
            padding: 10px;
            border-radius: 15px;
            max-width: calc(22.5% - 10px);
            gap: 10px;
            border: 2px solid #393E46;
            box-sizing: border-box;
        }

        .infoContent * {
            margin: 0;
        }

        .infoContent h2 {
            font-size: 15px;
            color: #f0f0f0;
            text-align: center;
            letter-spacing: 2px;
            margin-top: 2.5px;
        }

        .infoContent button {
            background-color: #222831;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .infoContent button:hover {
            transform: scale(1.05);
        }

        .infoContent img:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        #buttonReaksi {
            display: block;
            position: relative;
            margin: 10px auto;
            background-color: #ffd700;
            color: #1b2027;
            padding: 10px 20px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        #buttonReaksi:hover {
            transform: scale(1.05);
        }

        button:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        footer {
            width: 100%;
            background-color: #1a1d23;
            color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            border-top: 1.5px solid #333;
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

        <form action="hasil.php" method="post">
            <div id="pilihKarakter">
                <div id="infoList">
                    <?php
                    $karakter = getAllKaraktersWithElemental();
                    $chunkedKarakter = array_chunk($karakter, 5);
                    foreach ($chunkedKarakter as $karakterGroups): ?>
                        <div class="sub-List">
                            <?php foreach ($karakterGroups as $karakter): ?>
                                <div class="infoContent">
                                    <button type="button" class="input_karakter_pertama" name="karakter-pertama" value="<?= $karakter['karakter_id'] ?>">
                                        <img src="image/karakter/icon/<?= $karakter['image'] ?>" alt="<?= $karakter['image']; ?>" style="height: 75px;">
                                        <h2><?= $karakter['nama_karakter'] ?><h2>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="infoList">
                    <?php
                    $karakter = getAllKaraktersWithElemental();
                    $chunkedKarakter = array_chunk($karakter, 5);
                    foreach ($chunkedKarakter as $karakterGroups): ?>
                        <div class="sub-List">
                            <?php foreach ($karakterGroups as $karakter): ?>
                                <div class="infoContent">
                                    <button type="button" class="input_karakter_kedua" name="karakter-kedua" value="<?= $karakter['karakter_id'] ?>">
                                        <img src="image/karakter/icon/<?= $karakter['image'] ?>" alt="<?= $karakter['image']; ?>" style="height: 75px;">
                                        <h2><?= $karakter['nama_karakter'] ?><h2>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <input type="number" id="fields_karakter_id_pertama" name="id_karakter_pertama" value="" style="display: none;">
            <input type="number" id="fields_karakter_id_kedua" name="id_karakter_kedua" value="" style="display: none;">

            <button type="submit" id="buttonReaksi" name="button-reaksi">Tombol Reaksi</button>
        </form>

        <footer>
            <div class="optionalPage"></div>
            <div class="copyright">&copy; 2024 Genshin Impact Simulator. All rights reserved.</div>
        </footer>
    </div>

    <script>
        const karakterButtonsPertama = document.querySelectorAll('.input_karakter_pertama');
        const karakterButtonsKedua = document.querySelectorAll('.input_karakter_kedua');
        const fieldsKarakterIdPertama = document.getElementById('fields_karakter_id_pertama');
        const fieldsKarakterIdKedua = document.getElementById('fields_karakter_id_kedua');
        const tombolReaksi = document.getElementById('buttonReaksi');

        let selectedButtonPertama = null;
        let selectedButtonKedua = null;

        const toggleButtonState = () => {
            karakterButtonsKedua.forEach(button => {
                button.disabled = fieldsKarakterIdPertama.value === button.value;
            });
            karakterButtonsPertama.forEach(button => {
                button.disabled = fieldsKarakterIdKedua.value === button.value;
            });
        };

        const updateBorder = (button, isSelected) => {
            button.parentElement.style.border = isSelected ? '1px solid yellow' : '2px solid #393E46';
        };

        const handleKarakterClick = (buttons, field, selectedButtonRef) => {
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    if (selectedButtonRef) {
                        updateBorder(selectedButtonRef, false);
                    }

                    if (field.value === button.value) {
                        field.value = '';
                        selectedButtonRef = null;
                    } else {
                        field.value = button.value;
                        updateBorder(button, true);
                        selectedButtonRef = button;
                    }

                    toggleButtonState();
                });
            });
        };

        handleKarakterClick(karakterButtonsPertama, fieldsKarakterIdPertama, selectedButtonPertama);
        handleKarakterClick(karakterButtonsKedua, fieldsKarakterIdKedua, selectedButtonKedua);

        toggleButtonState();

        tombolReaksi.addEventListener('click', (event) => {
            if (fieldsKarakterIdPertama.value === '' || fieldsKarakterIdKedua.value === '') {
                event.preventDefault();
                alert('Silakan pilih kedua karakter untuk melanjutkan.');
                return;
            }

            <?php if (!isset($_SESSION['login']) || !$_SESSION['login']): ?>
                event.preventDefault();
                alert('Anda harus login untuk menggunakan fitur ini.');
                return;
            <?php endif; ?>
        });
    </script>
</body>

</html>