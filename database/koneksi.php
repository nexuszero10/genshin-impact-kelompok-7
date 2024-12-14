<?php
// Koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "genshin_impact");

// Cek koneksi
if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi registrasi
function registrasi($data){
    global $connection;

    $username = strtolower(stripcslashes($data['username']));
    $password = mysqli_real_escape_string($connection, $data['password']);
    $password2 = mysqli_real_escape_string($connection, $data['password2']);

    $result = mysqli_query($connection, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar!');
                window.location.href = 'register.php';
              </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sama');
                window.location.href = 'register.php';
              </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';
    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan');
                window.location.href = 'login.php';
              </script>";
    }

    return mysqli_affected_rows($connection);
}

// Fungsi untuk membaca data berdasarkan query
function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi untuk mendapatkan semua data dari tabel weapon
function getAllWeapons() {
    global $connection;

    $query = "SELECT * FROM weapon";
    $result = mysqli_query($connection, $query);

    $weapons = [];
    while ($weapon = mysqli_fetch_assoc($result)) {
        $weapons[] = $weapon;
    }

    return $weapons;
}

// Fungsi untuk mendapatkan semua data karakter dengan informasi dari tabel elemental
function getAllKaraktersWithElemental() {
    global $connection;

    $query = "SELECT karakter.karakter_id, karakter.nama_karakter, karakter.image, 
                     elemental.nama AS elemental_name, elemental.deskripsi AS elemental_description, elemental.image AS elemental_image
              FROM karakter
              LEFT JOIN elemental ON karakter.elemental_id = elemental.elemental_id";
    $result = mysqli_query($connection, $query);

    $karakters = [];
    while ($karakter = mysqli_fetch_assoc($result)) {
        $karakters[] = $karakter;
    }

    return $karakters;
}

// Fungsi untuk mendapatkan semua data dari tabel elemental
function getAllElementals() {
    global $connection;

    $query = "SELECT * FROM elemental";
    $result = mysqli_query($connection, $query);

    $elementals = [];
    while ($elemental = mysqli_fetch_assoc($result)) {
        $elementals[] = $elemental;
    }

    return $elementals;
}

// Fungsi untuk mendapatkan semua data dari tabel artifact
function getAllArtifacts() {
    global $connection;

    $query = "SELECT * FROM artifact";
    $result = mysqli_query($connection, $query);

    $artifacts = [];
    while ($artifact = mysqli_fetch_assoc($result)) {
        $artifacts[] = $artifact;
    }

    return $artifacts;
}

// Fungsi untuk mendapatkan karakter beserta data elemental berdasarkan karakter_id
function getCharacterWithElement($karakter_id) {
    global $connection;

    $query = "SELECT 
                karakter.karakter_id, 
                karakter.nama_karakter, 
                karakter.image AS karakter_image,
                elemental.elemental_id,
                elemental.nama AS elemental_name, 
                elemental.deskripsi AS elemental_description, 
                elemental.image AS elemental_image
              FROM karakter
              JOIN elemental ON karakter.elemental_id = elemental.elemental_id
              WHERE karakter.karakter_id = $karakter_id";

    $result = mysqli_query($connection, $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Mengembalikan data dalam bentuk array asosiatif
    } else {
        return null; // Jika tidak ditemukan
    }
}

// fungsi untuk mendapatkan semua data elemental reaction
function getSpesificReaction($elemental_id_1, $elemental_id_2){
    global $connection;

    $query = "SELECT reaction, elemental_id_1, elemental_id_2 
                FROM elemental_reaction 
                WHERE (elemental_id_1 = $elemental_id_1 AND elemental_id_2 = $elemental_id_2) 
                OR (elemental_id_1 = $elemental_id_2 AND elemental_id_2 = $elemental_id_1);
            ";
    
    $result = mysqli_query($connection,  $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Mengembalikan data dalam bentuk array asosiatif
    } else {
        return null; // Jika tidak ditemukan
    }
}

// fungsi untuk mendapatkan weapon rekomendation
function getWeaponRecomendation ($elemental_id_1, $elemental_id_2){
    global $connection;

    $query = "SELECT 
                wr.recommendation_weapon_id,
                wr.elemental_id_1,
                wr.elemental_id_2,
                w.weapon_id,
                w.weapon_name,
                w.deskripsi_efek_weapon,
                w.image
                FROM weapon_recomendation wr
                JOIN weapon w ON wr.weapon_id = w.weapon_id
                WHERE (wr.elemental_id_1 = $elemental_id_1 AND wr.elemental_id_2 = $elemental_id_2)
                OR (wr.elemental_id_1 = $elemental_id_2 AND wr.elemental_id_2 = $elemental_id_1);
            ";

    $result = mysqli_query($connection,  $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Mengembalikan data dalam bentuk array asosiatif
    } else {
        return null; // Jika tidak ditemukan
    }
}

// function untuk mendapatakan artifact recomendation
function getArtifactRecomendation($elemental_id_1, $elemental_id_2){
    global $connection;

    $query = "SELECT 
                ar.recommendation_artifact_id,
                ar.elemental_id_1,
                ar.elemental_id_2,
                a.artifact_id,
                a.artifact_name,
                a.deskripsi_efek_artifact,
                a.image
                FROM artifact_recomendation ar
                JOIN artifact a ON ar.artifact_id = a.artifact_id
                WHERE (ar.elemental_id_1 = $elemental_id_1 AND ar.elemental_id_2 = $elemental_id_2)
                OR (ar.elemental_id_1 = $elemental_id_2 AND ar.elemental_id_2 = $elemental_id_1);
            ";
    
    $result = mysqli_query($connection,  $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Mengembalikan data dalam bentuk array asosiatif
    } else {
        return null; // Jika tidak ditemukan
    }
}

?>
