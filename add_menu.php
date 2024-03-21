<?php
// Fungsi untuk menambahkan menu baru
function tambahMenu($namaMenu, $harga)
{
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
    $namaMenu = $conn->real_escape_string($namaMenu);
    $harga = $conn->real_escape_string($harga);

    // Query untuk menambahkan data menu baru
    $sql = "INSERT INTO `menu` (`namaMenu`, `harga`) VALUES ('$namaMenu', '$harga')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman admin.php setelah penambahan berhasil
        header("Location: admin.php");
        exit();
    } else {
        // Redirect ke halaman admin.php dengan pesan error jika penambahan gagal
        header("Location: admin.php?error=2");
        exit();
    }

    // Tutup koneksi database
    $conn->close();
}

// Fungsi untuk mendapatkan data menu dari database
function getMenuData()
{
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

    // Query untuk mendapatkan data menu
    $sql = "SELECT * FROM `menu`";
    $result = $conn->query($sql);

    // Tutup koneksi database
    $conn->close();

    return $result;
}

// Pastikan form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $namaMenu = $_POST["namaMenu"];
    $harga = $_POST["harga"];

    // Panggil fungsi untuk menambahkan menu
    tambahMenu($namaMenu, $harga);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Menu</title>
    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="text-center card-header bg-primary text-white">
                        TAMBAH MENU
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="namaMenu">Nama Menu:</label>
                                <input type="text" class="form-control" id="namaMenu" name="namaMenu" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">SIMPAN</button>
                        </form>
                        <a href="admin.php" class="btn btn-danger btn-block mt-3">BATAL</a>

                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
