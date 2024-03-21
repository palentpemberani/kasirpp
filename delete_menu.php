<?php
// Pastikan ID menu dikirimkan melalui parameter GET
if (isset($_GET['id'])) {
    $menuId = $_GET['id'];
} else {
    echo "ID menu tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Hapus</title>
    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus menu ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="delete_menu.php?id=<?= $menuId ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#deleteModal').modal('show');
    });
    </script>

</body>

</html>

<?php
// Jika tombol 'Hapus' ditekan dan ID menu valid, lakukan penghapusan
if (isset($_GET['id'])) {
    $menuId = $_GET['id'];

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

    // Query untuk menghapus data menu berdasarkan ID
    $sql = "DELETE FROM menu WHERE idMenu = $menuId";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman admin.php setelah penghapusan
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
} else {
    echo "ID menu tidak valid.";
}
?>