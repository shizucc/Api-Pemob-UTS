<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "api_anggota";
$conn = new mysqli($servername, $username, $password,
$dbname);
if ($conn->connect_error) {
die("Koneksi ke database gagal: " . $conn->connect_error);
}

?>