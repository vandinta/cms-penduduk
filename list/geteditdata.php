<?php
include_once("../connect.php");

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $result = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE id_penduduk = $id");

  if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $id_provinsi = $data['id_provinsi'];
    $id_kabupaten = $data['id_kabupaten'];
    $id_kecamatan = $data['id_kecamatan'];
    $kabupatenn = mysqli_query($mysqli, "SELECT kabupaten FROM tb_kabupaten WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten");
    while ($kabupaten = mysqli_fetch_array($kabupatenn)) {
      $data['kabupaten'] = $kabupaten['kabupaten'];
    }

    $kecamatann = mysqli_query($mysqli, "SELECT kecamatan FROM tb_kecamatan WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten AND id_kecamatan=$id_kecamatan");

    while ($kecamatan = mysqli_fetch_array($kecamatann)) {
      $data['kecamatan'] = $kecamatan['kecamatan'];
    }

    echo json_encode($data);
  } else {
    echo "Data not found";
  }
} else {
  echo "ID not provided";
}
