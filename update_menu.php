<?php
// Pastikan form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $menuId = $_POST["menuId"];
    $namaMenu = $_POST["namaMenu"];
    $harga = $_POST["harga"];

    // Lakukan koneksi ke database (gunakan koneksi yang sesuai dengan kebutuhan Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kasir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Sanitasi input untuk mencegah SQL injection
    $menuId = $conn->real_escape_string($menuId);
    $namaMenu = $conn->real_escape_string($namaMenu);
    $harga = $conn->real_escape_string($harga);

    // Query untuk memperbarui data menu berdasarkan ID
    $sql = "UPDATE `menu` SET `namaMenu` = '$namaMenu', `harga` = '$harga' WHERE `idMenu` = $menuId";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman admin.php setelah pembaruan berhasil
        header("Location: admin.php");
        exit();
    } else {
        // Redirect ke halaman admin.php dengan pesan error jika pembaruan gagal
        header("Location: admin.php?error=3");
        exit();
    }

    // Tutup koneksi database
    $conn->close();
} else {
    // Redirect ke halaman admin.php jika form tidak disubmit
    header("Location: admin.php");
    exit();
}
?>
