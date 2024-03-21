<?php
// Fungsi untuk mengupdate menu
function updateMenu($menuId, $namaMenu, $harga)
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
    $menuId = $conn->real_escape_string($menuId);
    $namaMenu = $conn->real_escape_string($namaMenu);
    $harga = $conn->real_escape_string($harga);

    // Query untuk mengupdate data menu
    $sql = "UPDATE `menu` SET `namaMenu`='$namaMenu', `harga`='$harga' WHERE `idMenu`='$menuId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman admin.php setelah update berhasil
        header("Location: admin.php");
        exit();
    } else {
        // Redirect ke halaman admin.php dengan pesan error jika update gagal
        header("Location: admin.php?error=3");
        exit();
    }

    // Tutup koneksi database
    $conn->close();
}

// Fungsi untuk mendapatkan data menu dari database berdasarkan ID
function getMenuById($menuId)
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

    // Query untuk mendapatkan data menu berdasarkan ID
    $sql = "SELECT * FROM `menu` WHERE `idMenu`='$menuId'";
    $result = $conn->query($sql);

    // Tutup koneksi database
    $conn->close();

    return $result->fetch_assoc();
}

// Pastikan form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $menuId = $_POST["menuId"];
    $namaMenu = $_POST["namaMenu"];
    $harga = $_POST["harga"];

    // Panggil fungsi untuk mengupdate menu
    updateMenu($menuId, $namaMenu, $harga);
} elseif (isset($_GET["id"])) {
    // Ambil ID dari parameter GET
    $menuId = $_GET["id"];

    // Panggil fungsi untuk mendapatkan data menu berdasarkan ID
    $menuData = getMenuById($menuId);

    // Periksa apakah data menu ditemukan
    if (!$menuData) {
        // Redirect ke halaman admin.php jika data tidak ditemukan
        header("Location: admin.php");
        exit();
    }
} else {
    // Redirect ke halaman admin.php jika tidak ada ID
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Menu</title>
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
                        EDIT MENU
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <input type="hidden" name="menuId" value="<?= $menuData['idMenu'] ?>">
                            <div class="form-group">
                                <label for="namaMenu">Nama Menu:</label>
                                <input type="text" class="form-control" id="namaMenu" name="namaMenu" value="<?= $menuData['namaMenu'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $menuData['harga'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">MEMPERBARUI</button>
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
