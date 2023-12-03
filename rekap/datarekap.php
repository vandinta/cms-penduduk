<?php
include_once("../connect.php");

$minUsia = isset($_POST['minUsia']) ? $_POST['minUsia'] : '';
$maxUsia = isset($_POST['maxUsia']) ? $_POST['maxUsia'] : '';
$minPendapatan = isset($_POST['minPendapatan']) ? $_POST['minPendapatan'] : '';
$maxPendapatan = isset($_POST['maxPendapatan']) ? $_POST['maxPendapatan'] : '';
$pendidikan = isset($_POST['pendidikan']) ? $_POST['pendidikan'] : '';

if (!empty($minUsia) || !empty($maxUsia) && !empty($minPendapatan) || !empty($maxPendapatan) && !empty($pendidikan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE usia >= $minUsia AND usia <= $maxUsia AND pendapatan >= $minPendapatan AND pendapatan <= $maxPendapatan AND tingkat_pendidikan LIKE '%$pendidikan%' ORDER BY id_penduduk ASC");
} elseif (!empty($minUsia) || !empty($maxUsia) && !empty($minPendapatan) || !empty($maxPendapatan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE usia >= $minUsia AND usia <= $maxUsia AND pendapatan >= $minPendapatan AND pendapatan <= $maxPendapatan ORDER BY id_penduduk ASC");
} elseif (!empty($minUsia) || !empty($maxUsia) && !empty($pendidikan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE usia >= $minUsia AND usia <= $maxUsia AND tingkat_pendidikan LIKE '%$pendidikan%' ORDER BY id_penduduk ASC");
} elseif (!empty($minPendapatan) || !empty($maxPendapatan) && !empty($pendidikan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE pendapatan >= $minPendapatan AND pendapatan <= $maxPendapatan AND tingkat_pendidikan LIKE '%$pendidikan%' ORDER BY id_penduduk ASC");
} elseif (!empty($minUsia) || !empty($maxUsia)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE usia >= $minUsia AND usia <= $maxUsia ORDER BY usia ASC");
} elseif (!empty($minPendapatan) || !empty($maxPendapatan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE pendapatan >= $minPendapatan AND pendapatan <= $maxPendapatan ORDER BY pendapatan ASC");
} elseif (!empty($pendidikan)) {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi WHERE tingkat_pendidikan LIKE '%$pendidikan%' ORDER BY id_penduduk ASC");
} else {
  $data = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi");
}

$i = 1;
foreach ($data as $row) {
  $id_provinsi = $row['id_provinsi'];
  $id_kabupaten = $row['id_kabupaten'];
  $id_kecamatan = $row['id_kecamatan'];
  $data_kabupaten = mysqli_query($mysqli, "SELECT * FROM tb_kabupaten WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten");
  $data_kecamatan = mysqli_query($mysqli, "SELECT * FROM tb_kecamatan WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten AND id_kecamatan=$id_kecamatan");

  setlocale(LC_TIME, 'id_ID');
  $tanggal = $row['tgl_lahir'];
  $tanggal_format_baru = strftime("%d %B %Y", strtotime($tanggal));

  $pendapatan = $row['pendapatan'];
  $pendapatan_format_rupiah = "Rp " . number_format($pendapatan, 0, ',', '.');

  if ($row['usia'] < 7) {
    echo '<tr class="table-danger">';
  } elseif ($row['usia'] >= 7 && $row['usia'] < 17) {
    echo '<tr class="table-warning">';
  } elseif ($row['usia'] >= 17 && $row['usia'] < 36) {
    echo '<tr class="table-success">';
  } else {
    echo '<tr class="table-primary">';
  }

  echo '<th>' . $i++ . '</th>';
  echo '<td>' . $row['nama'] . '</td>';
  echo '<td>' . $row['id_provinsi'] . ' ' . $row['provinsi'] . '</td>';
  while ($kabupaten = mysqli_fetch_array($data_kabupaten)) {
    echo '<td>' . $kabupaten['id_kabupaten'] . ' ' . $kabupaten['kabupaten'] . '</td>';
  }
  while ($kecamatan = mysqli_fetch_array($data_kecamatan)) {
    echo '<td>' . $kecamatan['id_kecamatan'] . ' ' . $kecamatan['kecamatan'] . '</td>';
  }
  echo '<td>' . $row['alamat'] . '</td>';
  echo '<td>' . $row['telp'] . '</td>';
  echo '<td>' . $tanggal_format_baru . '</td>';
  echo '<td>' . $row['usia'] . '</td>';
  echo '<td>' . $pendapatan_format_rupiah . '</td>';
  echo '<td>' . $row['tingkat_pendidikan'] . '</td>';
  echo '<td>' . $row['jenis_pekerjaan'] . '</td>';
  echo '<td>' . $row['keterangan'] . '</td>';
  echo '</tr>';
}
return
$pdo = null;
