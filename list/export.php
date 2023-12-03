<?php

include_once("../connect.php");
include_once("xlsxwriter.class.php");

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename = "Data-Penduduk.xlsx";
header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$writer = new XLSXWriter();
$writer->setAuthor('Some Author');

$styles1 = array(
  'font' => 'Arial',
  'font-size' => 8,
  'valign' => 'center',
  'halign' => 'center', 'border' => 'left,right,top,bottom'
);

$styles2 = array(
  'font' => 'Arial',
  'valign' => 'center',
  'font-style' => 'bold',
  'halign' => 'center', 'border' => 'left,right,top,bottom'
);


//==============================================================
//===========TITLE ============================================
//==============================================================

$writer->writeSheetRow(
  'Sheet1',
  array('LAPORAN Data Penduduk'),
  $styles2
);

$writer->writeSheetRow(
  'Sheet1',
  array('')
);

$writer->writeSheetRow(
  'Sheet1',
  array('')
);

$emparray = array();
$emparray[] = "No";
$emparray[] = "Id Penduduk";
$emparray[] = "Nama";
$emparray[] = "Provinsi";
$emparray[] = "Kabupaten";
$emparray[] = "Kecamatan";
$emparray[] = "Alamat";
$emparray[] = "No Telpon";
$emparray[] = "Tanggal Lahir";
$emparray[] = "Usia";
$emparray[] = "Pendapatan";
$emparray[] = "Tingkat Pendidikan";
$emparray[] = "Jenis Pekerjaan";
$emparray[] = "Keterangan";
$writer->writeSheetRow(
  'Sheet1',
  $emparray,
  $styles2
);

$result = mysqli_query($mysqli, "SELECT * FROM tb_penduduk INNER JOIN tb_provinsi ON tb_penduduk.id_provinsi = tb_provinsi.id_provinsi");

if (!$result) {
  $writer->writeSheetRow(
    'Sheet1',
    array('No data found'),
    $styles2
  );
} else {

  $emparray = array();
  $no = 1;

  while ($row = $result->fetch_assoc()) {
    $id_provinsi = $row['id_provinsi'];
    $id_kabupaten = $row['id_kabupaten'];
    $id_kecamatan = $row['id_kecamatan'];
    $data_kabupaten = mysqli_query($mysqli, "SELECT * FROM tb_kabupaten WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten");
    $data_kecamatan = mysqli_query($mysqli, "SELECT * FROM tb_kecamatan WHERE id_provinsi=$id_provinsi AND id_kabupaten=$id_kabupaten AND id_kecamatan=$id_kecamatan");

    while ($kabupaten = mysqli_fetch_array($data_kabupaten)) {
      $nama_kabupaten = $kabupaten['kabupaten'];
    }
    while ($kecamatan = mysqli_fetch_array($data_kecamatan)) {
      $nama_kecamatan = $kecamatan['kecamatan'];
    }

    setlocale(LC_TIME, 'id_ID');
    $tanggal = $row['tgl_lahir'];
    $tanggal_format_baru = strftime("%d %B %Y", strtotime($tanggal));

    $pendapatan = $row['pendapatan'];
    $pendapatan_format_rupiah = "Rp " . number_format($pendapatan, 0, ',', '.');

    $dataarray = array();
    $dataarray[] = $no;
    $dataarray[] = $row['id_penduduk'];
    $dataarray[] = $row['nama'];
    $dataarray[] = $row['id_provinsi'] . ' ' . $row['provinsi'];
    $dataarray[] = $row['id_kabupaten'] . ' ' . $nama_kabupaten;
    $dataarray[] = $row['id_kecamatan'] . ' ' . $nama_kecamatan;
    $dataarray[] = $row['alamat'];
    $dataarray[] = $row['telp'];
    $dataarray[] = $tanggal_format_baru;
    $dataarray[] = $row['usia'];
    $dataarray[] = $pendapatan_format_rupiah;
    $dataarray[] = $row['tingkat_pendidikan'];
    $dataarray[] = $row['jenis_pekerjaan'];
    $dataarray[] = $row['keterangan'];


    $writer->writeSheetRow(
      'Sheet1',
      $dataarray,
      $styles1
    );

    $no += 1;
  }
}

$writer->writeSheetRow(
  'Sheet1',
  array('')
);
$writer->writeSheetRow(
  'Sheet1',
  array('')
);

$writer->writeSheetRow(
  'Sheet1',
  array('')
);

$writer->markMergedCell('Sheet1', $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 2);

$writer->writeToStdOut();

exit(0);
