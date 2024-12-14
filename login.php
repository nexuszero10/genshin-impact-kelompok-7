<?php
session_start();
require_once 'database/koneksi.php';

if (isset($_POST['submitLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            echo "<script>
                    alert('Login berhasil!');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    window.location.href = 'login.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Username tidak ditemukan!');
                window.location.href = 'login.php';
              </script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
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

        #loginContainer * {
            padding: 0;
            margin: 0;
        }

        #loginContainer {
            background-color: #222831;
            display: flex;
            flex-direction: column;
            width: 30%;
            margin: 0 auto;
            margin-top: 80px;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border-radius: 20px;
            min-height: 400px;
            padding: 20px;
            border: 1px solid #FFDB00;
        }

        #loginContainer h1 {
            font-size: 40px;
            letter-spacing: 2.5px;
            margin-bottom: 20px;
            color: #ffd700;
        }

        #loginForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 85%;
            gap: 15px;
            margin-bottom: 10px;
        }

        #loginForm input::placeholder {
            color: #fff;
            /* Ganti warna dengan yang diinginkan */
        }

        #loginForm input {
            border: 1px solid #ffd700;
            padding: 12px 10px;
            border-radius: 5px;
            background-color: rgb(57, 62, 70);
            color: #ffffff;
            width: 100%;
            font-size: 16px;
            transition: 0.3s ease;
        }

        #loginForm input:focus {
            outline: none;
            border-color: #FFDB00;
            box-shadow: 0px 0px 8px rgba(255, 219, 0, 0.6);
        }

        #loginForm button {
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #222831;
            background-color: #ffd700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #loginForm button:hover {
            background-color: #FFDB00;
        }

        #loginContainer a {
            font-size: 15px;
            color: white;
            letter-spacing: 1px;
        }

        #loginContainer a:hover {
            text-decoration: underline;
        }

        .cookieCheckbox {
            display: flex;
            align-items: center;
            gap: 15px;
            width: max-content;
            white-space: nowrap;
        }

        .cookieCheckbox label {
            font-size: 16.5px;
        }

        .cookieCheckbox input[type="checkbox"] {
            accent-color: #ffd700;
            border: 2px solid #ffd700;
        }

        .optionLogin {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            width: 100%;
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
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </header>

        <div id="loginContainer">
            <h1>Login</h1>
            <form action="" method="post" id="loginForm">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" name="submitLogin">Login</button>
            </form>
            <a href="/register.php">Belum punya akun ? Regstrasi</a>
        </div>

    </div>
</body>

</html>