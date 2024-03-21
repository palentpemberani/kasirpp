<?php
include('koneksi.php');

$idPelanggan = "";
$namaMenu = "";


if (isset($_GET['id'])) {
    $idPelanggan = $_GET['id'];

    $query = "SELECT idPelanggan, namaMenu, idMenu, harga FROM pesan WHERE idPelanggan = '$idPelanggan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $namaMenu = $row['namaMenu'];
        $harga = $row['harga'];
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

$queryMenu = "SELECT idMenu, namaMenu, harga FROM menu";
$resultMenu = mysqli_query($koneksi, $queryMenu);

if (!$resultMenu) {
    echo "Error: " . mysqli_error($koneksi);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPelanggan = $_POST['idPelanggan'];

    $namaMenu = $_POST['namaMenu'];

    $hargaQuery = "SELECT harga FROM menu WHERE namaMenu = '$namaMenu'";
    $hargaResult = mysqli_query($koneksi, $hargaQuery);

    if ($hargaResult) {
        $hargaRow = mysqli_fetch_assoc($hargaResult);
        $harga = $hargaRow['harga'];

        $updateQuery = "UPDATE pesan SET namaMenu='$namaMenu', harga='$harga' WHERE idPelanggan='$idPelanggan'";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        if ($updateResult) {
            echo "Data berhasil diupdate.";
            header("Location: waiter.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error fetching menu price: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Order</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="text-center card-header bg-primary text-white">
                    EDIT MENU
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="idPelanggan">ID Pelanggan:</label>
                            <input type="text" class="form-control" id="idPelanggan" name="idPelanggan" value="<?php echo $idPelanggan; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="namaMenu">Nama Menu:</label>
                            <select class="form-control" id="namaMenu" name="namaMenu" required>
                                <?php
                                while ($rowMenu = mysqli_fetch_assoc($resultMenu)) {
                                    $selected = ($rowMenu['namaMenu'] == $namaMenu) ? "selected" : "";
                                    echo "<option value='{$rowMenu['namaMenu']}' $selected>{$rowMenu['namaMenu']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>