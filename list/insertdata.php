<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'db_rekap');

if (isset($_POST['insertdata'])) {
    $nama = $_POST['nama'];
    $id_provinsi = $_POST['provinsi'];
    $id_kabupaten = $_POST['kabupaten'];
    $id_kecamatan = $_POST['kecamatan'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $data_tgl_lahir = new DateTime($tgl_lahir);
    $time = new DateTime();
    $usia = $time->diff($data_tgl_lahir)->y;

    $pendapatan = $_POST['pendapatan'];
    $tingkat_pendidikan = $_POST['tingkat_pendidikan'];
    $jenis_pekerjaan = $_POST['jenis_pekerjaan'];
    $keterangan = $_POST['keterangan'];
    
    if ($telp < 8 && $telp > 14) {
        echo '<script> alert("Nomor Telpon Minimal 8 Karakter dan Maksimal 14 Karakter"); </script>';
        header('Location: index.php');
    }

    $query = "INSERT INTO tb_penduduk (`nama`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`alamat`,`telp`,`tgl_lahir`,`usia`,`pendapatan`,`tingkat_pendidikan`,`jenis_pekerjaan`,`keterangan`) VALUES ('$nama','$id_provinsi','$id_kabupaten','$id_kecamatan','$alamat','$telp','$tgl_lahir','$usia','$pendapatan','$tingkat_pendidikan','$jenis_pekerjaan','$keterangan')";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo '<script> alert("Data Berhasil Disimpan"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Gagal Disimpan"); </script>';
    }
}
