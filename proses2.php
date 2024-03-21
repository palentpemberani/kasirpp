<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kasir";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data menu
$sql = "SELECT idPelanggan, namaMenu, idMenu, harga FROM pesan";
$result = $conn->query($sql);

// Memeriksa apakah ada hasil
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["idPelanggan"] . "</td>
                <td>" . $row["namaMenu"] . "</td>
                <td>" . $row["idMenu"] . "</td>
                <td>" . $row["harga"] . "</td>
                
               
          </tr>";
    }
} else {
    echo "0 hasil";
}

// Menutup koneksi database
$conn->close();
