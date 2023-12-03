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
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label>Usia</label>
                <div class="row" style="margin-left: 2px;">
                  <div class="coloum">
                    <input type="number" name="minusia" id="minusia" class="form-control" placeholder="Batas Min Usia">
                  </div>
                  <div class="coloum" style="margin-top: 8px; margin-left: 20px;">
                    <h6> - </h6>
                  </div>
                  <div class="coloum" style="margin-left: 20px;">
                    <input type="number" name="maxusia" id="maxusia" class="form-control" placeholder="Batas Max Usia">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Pendapatan</label>
                <div class="row" style="margin-left: 2px;">
                  <div class="coloum">
                    <input type="number" name="minpendapatan" id="minpendapatan" class="form-control" placeholder="Batas Min Pendapatan">
                  </div>
                  <div class="coloum" style="margin-top: 8px; margin-left: 20px;">
                    <h6> - </h6>
                  </div>
                  <div class="coloum" style="margin-left: 20px;">
                    <input type="number" name="maxpendapatan" id="maxpendapatan" class="form-control" placeholder="Batas Max Pendapatan">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Jenjang Pendidikan</label>
                <input type="text" name="pendidikan" id="pendidikan" class="form-control" placeholder="Jenjang Pendidikan">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="rekap-button" class="btn btn-primary">Rekap</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card" style="margin-top: 50px;">
        <div class="card-body">
          <table class="table table-bordered" style="text-align: center;">
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

        $('#rekap-button').on('click', function() {
          $("#minusia").val();
          $("#maxusia").val();
          loadData();
        });

        function loadData() {
          var minUsia = $("#minusia").val();
          var maxUsia = $("#maxusia").val();
          var minPendapatan = $("#minpendapatan").val();
          var maxPendapatan = $("#maxpendapatan").val();
          var pendidikan = $("#pendidikan").val();

          $.ajax({
            url: 'datarekap.php',
            method: 'POST',
            data: {
              minUsia,
              maxUsia,
              minPendapatan,
              maxPendapatan,
              pendidikan
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