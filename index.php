<?php
include('koneksi.php');
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM anggota WHERE id = $id";
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $anggota = $result->fetch_assoc();
            echo json_encode($anggota);
        } else {
            echo "Data anggota dengan ID $id tidak ditemukan.";
        }
    } 
    else {
        $sql = "SELECT * FROM anggota";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $anggota = array();
            while ($row = $result->fetch_assoc()) {
                $anggota[] = $row;
            }
            echo json_encode($anggota);
        } else {
            echo "Data anggota kosong.";
        }
    }
}


if ($method === "POST") {
    // Menambahkan data anggota
   $data = json_decode(file_get_contents("php://input"), true);
   $nama = $data["nama"];
   $tugas = $data["tugas"];
   $sql = "INSERT INTO anggota (nama, tugas) VALUES ('$nama', '$tugas')";
   if ($conn->query($sql) === TRUE) {
   $data['pesan'] = 'berhasil';
   //echo "Berhasil tambah data";
   } else {
   $data['pesan'] = "Error: " . $sql . "<br>" . $conn->error;
   }
   echo json_encode($data);
   } 

   if ($method === "PUT") {
    // Memperbarui data anggota
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data["id"];
        $nama = $data["nama"];
        $tugas = $data["tugas"];
        $sql = "UPDATE anggota SET nama='$nama', tugas='$tugas' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $data['pesan'] = 'berhasil';
        } else {
         $data['pesan'] =  "Error: " . $sql . "<br>" . $conn->error;
        }
        echo json_encode($data);
   } 

   if ($method === "DELETE") {
    // Menghapus data anggota
   $id = $_GET["id"];
   $sql = "DELETE FROM anggota WHERE id=$id";
   if ($conn->query($sql) === TRUE) {
   $data['pesan'] = 'berhasil';
   } else {
   $data['pesan'] = "Error: " . $sql . "<br>" . $conn->error;
   }
   echo json_encode($data);
   }
   $conn->close();
?>