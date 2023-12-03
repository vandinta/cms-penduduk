<?php
include '../connect.php';

global $koneksi;

if (isset($_POST['updatedata'])) {
    $id = $_POST["update_id"];
    $nama = $_POST['name'];

    if (empty($_POST['provinsii']) && empty($_POST['kabupatenn']) && empty($_POST['kecamatann'])) {
        $id_provinsi = $_POST['id_province'];
        $id_kabupaten = $_POST['id_regency'];
        $id_kecamatan = $_POST['id_subdistrict'];
    } else {
        $id_provinsi = $_POST['provinsii'];
        $id_kabupaten = $_POST['kabupatenn'];
        $id_kecamatan = $_POST['kecamatann'];
    }

    $alamat = $_POST['address'];
    $telp = $_POST['phone'];
    $tgl_lahir = $_POST['date_birth'];

    $data_tgl_lahir = new DateTime($tgl_lahir);
    $time = new DateTime();
    $usia = $time->diff($data_tgl_lahir)->y;

    $pendapatan = $_POST['sellery'];
    $tingkat_pendidikan = $_POST['education'];
    $jenis_pekerjaan = $_POST['work'];
    $keterangan = $_POST['addtext'];

    $query = "UPDATE tb_penduduk SET nama = '$nama', id_provinsi = '$id_provinsi', id_kabupaten = '$id_kabupaten', id_kecamatan = '$id_kecamatan', alamat = '$alamat', telp = '$telp', tgl_lahir = '$tgl_lahir', usia = '$usia', pendapatan = '$pendapatan', tingkat_pendidikan = '$tingkat_pendidikan', jenis_pekerjaan = '$jenis_pekerjaan', keterangan = '$keterangan' WHERE id_penduduk = '$id'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo '<script> alert("Data Berhasil Diupdate"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Gagal Diupdate"); </script>';
    }
}
