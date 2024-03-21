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
$sql = "SELECT idMenu, namaMenu, harga FROM menu";
$result = $conn->query($sql);

// Memeriksa apakah ada hasil
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["namaMenu"] . "</td>
                <td>Rp. " . $row["harga"] . "</td>;
                <td>";

        // Cek apakah halaman saat ini adalah admin.php
        if (basename($_SERVER['PHP_SELF']) == 'admin.php') {
            // Tampilkan tombol Edit dan Hapus jika halaman adalah admin.php
            echo "<a href='edit_menu.php?id=" . $row["idMenu"] . "' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete_menu.php?id=" . $row["idMenu"] . "' class='btn btn-danger btn-sm'>Hapus</a>";
        }

        echo "</td>
              </tr>";
    }
} else {
    echo "0 hasil";
}

// Menutup koneksi database
$conn->close();
