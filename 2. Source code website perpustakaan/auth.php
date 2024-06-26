<?php
include('connect.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada dalam tabel user
    $sqlUser = "SELECT * FROM anggota WHERE username = '$username'";
    $resultUser = mysqli_query($connect, $sqlUser);

    $sqlPetugas = "SELECT * FROM petugas WHERE username = '$username'";
    $resultPetugas = mysqli_query($connect, $sqlPetugas);

    if ($resultUser && mysqli_num_rows($resultUser) > 0) {
        // Username ditemukan dalam tabel user
        $rowUser = mysqli_fetch_assoc($resultUser);
        $passwordVal = $rowUser["password"];

        if ($password !== $passwordVal) {
            http_response_code(401);
            $response = json_encode([
                "success" => false,
                "message" => "Password Anda salah",
                "data" => null,
            ]);

            echo $response;
        } else {
            // Authentication successful

       
            $_SESSION['user_id'] = $rowUser['id_anggota'];
            $_SESSION['username'] = $rowUser['username'];

            header("Location: dashboarduser.php");
            exit;
        }
    } elseif($resultPetugas && mysqli_num_rows($resultPetugas) > 0){
        $rowPetugas = mysqli_fetch_assoc($resultPetugas);
        $passwordVal = $rowPetugas["password"];

        if ($password !== $passwordVal) {
            http_response_code(401);
            $response = json_encode([
                "success" => false,
                "message" => "Password Anda salah",
                "data" => null,
            ]);

            echo $response;
        } else {
            // Authentication successful

            $_SESSION['user_id'] = $rowPetugas['id_pustakawan'];
            $_SESSION['username'] = $rowPetugas['username'];

            header("Location: dashboardadmin.php");
            exit;
        }
    }
    else {
        http_response_code(401);
        $response = json_encode([
            "success" => false,
            "message" => "Login failed. Invalid email or password.",
            "data" => null,
        ]);

        echo $response;
    }
}
