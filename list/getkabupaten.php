<?php
include_once("../connect.php");

$provinsiId = $_POST['provinsiId'];
$kabupatenResult = mysqli_query($mysqli,"SELECT * FROM tb_kabupaten WHERE id_provinsi = $provinsiId");

echo '<option value="">Pilih Kabupaten</option>';

foreach ($kabupatenResult as $kabupaten) {
  echo '<option data-provinsi="' . $kabupaten['id_provinsi'] . '" value="' . $kabupaten['id_kabupaten'] . '">' . $kabupaten['kabupaten'] . '</option>';
}
