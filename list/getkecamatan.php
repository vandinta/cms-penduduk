<?php
include_once("../connect.php");

$provinsiId = $_POST['provinsiId'];
$kabupatenId = $_POST['kabupatenId'];

$kecamatanResult = mysqli_query($mysqli,"SELECT * FROM tb_kecamatan WHERE id_provinsi = $provinsiId AND id_kabupaten = $kabupatenId");

echo '<option value="">Pilih Kecamatan</option>';

foreach ($kecamatanResult as $kecamatan) {
  echo '<option value="' . $kecamatan['id_kecamatan'] . '">' . $kecamatan['kecamatan'] . '</option>';
}
