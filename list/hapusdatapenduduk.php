<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_penduduk WHERE id_penduduk = '$id'";
    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        die("Data gagal dihapus." . mysqli_errno($mysqli) . mysqli_error($mysqli));
    } else {
        echo "<script>
                alert('Data Berhasil Dihapus !');
                window.location.href='index.php';
              </script>";
    }
}
