<?php
include '../connect.php';
?>

<!doctype html>
<html lang="en">

<?php
include '../template/head.php';
?>

<style>

</style>

<body>
  <div id="wrapper">
    <div class="overlay"></div>

    <?php
    include '../template/navbar.php';
    ?>

    <div class="col" style="margin-top: 50px;">
      <center>
        <h2><strong>Rekap Data Penduduk</strong></h2>
      </center>

      <div class="card" style="margin-top: 50px;">
        <div class="card-body">
          <form action="insertdata.php" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <label>Provinsi</label><br>
                <select id="provinsi" name="provinsi" required>
                  <option value="">Pilih Provinsi</option>
                  <?php
                  $data = mysqli_query($mysqli, "SELECT * FROM tb_provinsi");

                  foreach ($data as $row) {
                    echo '<option value="' . $row['id_provinsi'] . '">' . $row['provinsi'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Kabupaten</label><br>
                <select id="kabupaten" name="kabupaten" required>
                </select>
              </div>
              <div class="form-group">
                <label>kecamatan</label><br>
                <select id="kecamatan" name="kecamatan" required>
                </select>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
              </div>
              <div class="form-group">
                <label>Telp/Hp</label>
                <input type="number" name="telp" id="telp" class="form-control" placeholder="Telp/Hp" required>
              </div>
              <div class="form-group">
                <label>Tgl Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tgl Lahir" required>
              </div>
              <div class="form-group">
                <label>Pendapatan</label>
                <input type="text" name="pendapatan" id="pendapatan" class="form-control" placeholder="Pendapatan" required>
              </div>
              <div class="form-group">
                <label>Pendidikan</label>
                <input type="text" name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-control" placeholder="Pendidikan" required>
              </div>
              <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" class="form-control" placeholder="Pekerjaan" required>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card" style="margin-top: 50px;">
        <div class="card-body">
          <table class="table table-bordered" style="text-align: center; margin-left: -14px;">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th width="20px" scope="col">Provinsi</th>
                <th width="20px" scope="col">Kabupaten</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telp/HP</th>
                <th scope="col">Tgl Lahir</th>
                <th scope="col">Usia</th>
                <th scope="col">Pendapatan</th>
                <th scope="col">Tingkat Pendidikan</th>
                <th scope="col">Jenis Pekerjaan</th>
                <th scope="col">Keterangan</th>
              </tr>
            </thead>
            <tbody id="data-container">
            </tbody>
          </table>
        </div>
      </div>
      <br><br>
    </div>

    <?php
    include '../template/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      $(document).ready(function() {
        loadData();

        function loadData() {
          $.ajax({
            url: 'datapenduduk.php',
            method: 'POST',
            data: {
              search: searchData,
              sort: sortData
            },
            success: function(response) {
              $('#data-container').html(response);
            },
            error: function(error) {
              console.error('Error loading data:', error);
            }
          });
        }
      });
    </script>
</body>

</html>