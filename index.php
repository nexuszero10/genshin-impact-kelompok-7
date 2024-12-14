<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="/image/home/logo.png">
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            background-color: #1b2027;
            color: #ffffff;
        }

        #container {
            width: auto;
        }

        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        .page {
            font-size: 30px;
            font-style: italic;
            color: #ffd700;
            text-align: center;
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
            margin-bottom: 45px;
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
            margin-left: 10px;
            gap: 10px;
            padding: 0;
            align-items: center;
            justify-content: flex-start;
        }

        nav ul li {
            cursor: pointer;
        }

        nav li {
            font-size: 18px;
            background-color: #393E46;
            color: #ffd700;
            padding: 10px 15px;
            border-radius: 30px;
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

        #sliderContainer {
            position: relative;
            width: 70%;
            margin: auto;
            overflow: hidden;
            display: flex;
            align-items: center;
            margin-top: 25px;
        }

        #slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .slide img {
            width: 85%;
            height: 450px;
            border-radius: 20px;
        }

        .slide h2 {
            display: inline-block;
            font-size: 20px;
            background-color: #393E46;
            color: #ffd700;
            padding: 10px 15px;
            border-radius: 30px;
            margin-top: 25px;
            letter-spacing: 2.5px;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-100%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
            z-index: 1;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
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

        <div id="sliderContainer">
            <button class="arrow prev" onclick="prevSlide()">&#10094;</button>
            <div id="slider">
                <div class="slide">
                    <img src="image/home/poster1.png" alt="poster1">
                    <br>
                    <h2>Gnehsin Impact</h2>
                </div>
                <div class="slide">
                    <img src="image/home/poster2.png" alt="poster2">
                    <br>
                    <h2>Yelan</h2>
                </div>
                <div class="slide">
                    <img src="image/home/poster3.png" alt="poster3">
                    <br>
                    <h2>Raiden Shogun</h2>
                </div>
                <div class="slide">
                    <img src="image/home/poster4.png" alt="poster4">
                    <br>
                    <h2>Yae Miko</h2>
                </div>
            </div>
            <button class="arrow next" onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const slider = document.getElementById('slider');
            const slides = document.querySelectorAll('.slide');
            if (index >= slides.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = slides.length - 1;
            } else {
                currentIndex = index;
            }
            slider.style.transform = `translateX(${-currentIndex * 100}%)`;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSlide(currentIndex);
        });

        setInterval(() => {
            nextSlide();
        }, 3500);
    </script>
</body>

</html>
