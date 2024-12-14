<?php
require_once 'database/koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deatil Wepaon</title>
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

        #infoList {
            display: flex;
            flex-direction: column;
            padding: 5px;
            width: 85%;
            margin: 0 auto;
            border-radius: 25px;
            gap: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .sub-List {
            display: flex;
            flex-direction: row;
            justify-content: center;
            padding: 5px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .infoContent {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #222831;
            padding: 15px;
            border-radius: 15px;
            max-width: calc(25% - 10px);
            gap: 5px;
            justify-content: space-between;
            border: 2px solid #393E46;
            box-sizing: border-box;
        }

        .infoContent * {
            margin: 0;
        }

        .infoContent h2 {
            font-size: 20.5px;
            text-align: center;
            padding-bottom: 10px;
            letter-spacing: 2px;
        }

        .infoContent p {
            text-align: center;
            font-size: 15px;
        }

        .infoContent img {
            width: 100%;
            height: 200px;
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .infoButton {
            display: flex;
            flex-direction: row;
            padding: 5px;
            justify-content: center;
            gap: 17.5px;
            margin-top: auto;
        }

        .infoButton button {
            background-color: #FFDB00;
            font-size: 16.5px;
            border-radius: 30px;
            padding: 5px 8.5px;
            border: none;
            letter-spacing: 1px;
            transition: transform 0.3s ease-in-out;
            margin-top: 20px;
        }

        .infoButton button:hover {
            cursor: pointer;
            transform: scale(1.1);
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

        <div id="infoList" style="width: 90%;">
            <?php
            $weapon = getAllWeapons();
            $chunkedWeapon = array_chunk($weapon, 5);
            foreach ($chunkedWeapon as $weaponGroup): ?>
                <div class="sub-List">
                    <?php foreach ($weaponGroup as $weaponItem): ?>
                        <div class="infoContent">
                            <img src="image/weapon/<?= $weaponItem['image'] ?>" alt="<?= $weaponItem['image']; ?>" style="height: 300px;">
                            <h2><?= $weaponItem['weapon_name'] ?></h2>
                            <p style="font-size: 15px;"><?= $weaponItem['deskripsi_efek_weapon'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>


        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Genshin Impact Simulator. All rights reserved.</div>
        </footer>
    </div>
</body>

</html>