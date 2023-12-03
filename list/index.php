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
        <h2><strong>Data Penduduk</strong></h2>
      </center>

      <div class="card" style="margin-top: 50px;">
        <div class="card-body">
          <div class="button" style="margin-bottom: 15px; margin-left: -14px;">
            <div class="coloum">
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addmodal">Tambah Data</button>
              <button type="button" class="btn btn-outline-success" id="export-button">Export Excel</button>
              <button type="button" class="btn btn-outline-info" id="refresh-button">Refresh Data</button>
              <div class="btn-group">
                <select id="filter-sort">
                  <option value="">Pilih Filter</option>
                  <option value="nama">Nama</option>
                  <option value="usia">Tanggal Lahir</option>
                  <option value="pendapatan">Pendapatan</option>
                </select>
              </div>
              <div class="div float-right">
                <div class="row">
                  <div class="column">
                    <input class="form-control" type="text" id="search" placeholder="Search" aria-label="Search">
                  </div>
                  <button type="button" class="btn btn-outline-success" id="search-input" style="margin-left: 10px;">Search</button>
                </div>
              </div>
            </div>
          </div>
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
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody id="data-container">
            </tbody>
          </table>
        </div>
      </div>
      <br><br>
    </div>

    <!-- Add -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penduduk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

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
    </div>

    <!-- Edit -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Edit Data Penduduk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="updatedata.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nama">
              </div>
              <div class="form-group">
                <label>Provinsi</label><br>
                <input type="text" name="province" id="province" class="form-control" readonly>
                <input type="hidden" name="id_province" id="id_province" class="form-control">
              </div>
              <div class="form-group">
                <label>Kabupaten</label><br>
                <input type="text" name="regency" id="regency" class="form-control" readonly>
                <input type="hidden" name="id_regency" id="id_regency" class="form-control">
              </div>
              <div class="form-group">
                <label>Kecamatan</label><br>
                <input type="text" name="subdistrict" id="subdistrict" class="form-control" readonly>
                <input type="hidden" name="id_subdistrict" id="id_subdistrict" class="form-control">
              </div>
              <div class="form-group">
                <label>Ubah Provinsi</label><br>
                <select id="provinsii" name="provinsii">
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
                <label>Ubah Kabupaten</label><br>
                <select id="kabupatenn" name="kabupatenn">
                </select>
              </div>
              <div class="form-group">
                <label>Ubah Kecamatan</label><br>
                <select id="kecamatann" name="kecamatann">
                </select>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Alamat">
              </div>
              <div class="form-group">
                <label>Telp/Hp</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Telp/Hp">
              </div>
              <div class="form-group">
                <label>Tgl Lahir</label>
                <input type="date" name="date_birth" id="date_birth" class="form-control" placeholder="Tgl Lahir">
              </div>
              <div class="form-group">
                <label>Usia</label>
                <input type="text" name="old" id="old" class="form-control" placeholder="Usia" disabled>
              </div>
              <div class="form-group">
                <label>Pendapatan</label>
                <input type="text" name="sellery" id="sellery" class="form-control" placeholder="Pendapatan">
              </div>
              <div class="form-group">
                <label>Tingkat Pendidikan</label>
                <input type="text" name="education" id="education" class="form-control" placeholder="Tingkat Pendidikan">
              </div>
              <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <input type="text" name="work" id="work" class="form-control" placeholder="Jenis Pekerjaan">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="addtext" id="addtext" class="form-control" placeholder="Keterangan">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Detail-->
    <div class="modal fade" id="showmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Detail Data Penduduk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="showname" id="showname" class="form-control" placeholder="Nama" readonly>
              </div>
              <div class="form-group">
                <label>Provinsi</label><br>
                <input type="text" name="showprovince" id="showprovince" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Kabupaten</label><br>
                <input type="text" name="showregency" id="showregency" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Kecamatan</label><br>
                <input type="text" name="showsubdistrict" id="showsubdistrict" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="showaddress" id="showaddress" class="form-control" placeholder="Alamat" readonly>
              </div>
              <div class="form-group">
                <label>Telp/Hp</label>
                <input type="text" name="showphone" id="showphone" class="form-control" placeholder="Telp/Hp" readonly>
              </div>
              <div class="form-group">
                <label>Tgl Lahir</label>
                <input type="date" name="showdate_birth" id="showdate_birth" class="form-control" placeholder="Tgl Lahir" readonly>
              </div>
              <div class="form-group">
                <label>Usia</label>
                <input type="text" name="showold" id="showold" class="form-control" placeholder="Usia" readonly>
              </div>
              <div class="form-group">
                <label>Pendapatan</label>
                <input type="text" name="showsellery" id="showsellery" class="form-control" placeholder="Pendapatan" readonly>
              </div>
              <div class="form-group">
                <label>Tingkat Pendidikan</label>
                <input type="text" name="showeducation" id="showeducation" class="form-control" placeholder="Tingkat Pendidikan" readonly>
              </div>
              <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <input type="text" name="showwork" id="showwork" class="form-control" placeholder="Jenis Pekerjaan" readonly>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="showaddtext" id="showaddtext" class="form-control" placeholder="Keterangan" readonly>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <?php
    include '../template/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      $(document).ready(function() {
        loadData();

        $('#search-input').on('click', function() {
          loadData();
        });

        $('#filter-sort').on('click', function() {
          loadData();
        });

        $('#export-button').on('click', function() {
          window.location.href = "export.php";
        });

        $('#refresh-button').on('click', function() {
          $("#search").val('');
          $("#filter-sort").val('');
          loadData();
        });

        function loadData() {
          var searchData = $('#search').val();
          var sortData = $('#filter-sort').val();

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

        $('#provinsi, #provinsii').change(function() {
          var provinsiId = $(this).val();

          $.ajax({
            type: 'POST',
            url: 'getkabupaten.php',
            data: {
              provinsiId: provinsiId
            },
            success: function(data) {
              $('#kabupaten').html(data);
              $('#kabupatenn').html(data);
            }
          });
        });

        $('#kabupaten').change(function() {
          var kabupatenId = $(this).val();
          var provinsiId = $('#kabupaten option:selected').data('provinsi');;

          $.ajax({
            type: 'POST',
            url: 'getkecamatan.php',
            data: {
              provinsiId: provinsiId,
              kabupatenId: kabupatenId
            },
            success: function(data) {
              $('#kecamatan').html(data);
            }
          });
        });

        $('#kabupatenn').change(function() {
          var kabupatenId = $(this).val();
          var provinsiId = $('#kabupatenn option:selected').data('provinsi');;

          $.ajax({
            type: 'POST',
            url: 'getkecamatan.php',
            data: {
              provinsiId: provinsiId,
              kabupatenId: kabupatenId
            },
            success: function(data) {
              $('#kecamatann').html(data);
            }
          });
        });
      });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      function editData(id) {
        $('#editmodal').modal('show');

        $.ajax({
          type: "POST",
          url: "geteditdata.php",
          data: {
            id: id
          },
          dataType: "json",
          success: function(data) {
            console.log(data);
            $("#name").val(data.nama);
            $("#id_province").val(data.id_provinsi);
            $("#province").val(data.provinsi);
            $("#id_regency").val(data.id_kabupaten);
            $("#regency").val(data.kabupaten);
            $("#id_subdistrict").val(data.id_kecamatan);
            $("#subdistrict").val(data.kecamatan);
            $("#address").val(data.alamat);
            $("#phone").val(data.telp);
            $("#date_birth").val(data.tgl_lahir);
            $("#old").val(data.usia);
            $("#sellery").val(data.pendapatan);
            $("#education").val(data.tingkat_pendidikan);
            $("#work").val(data.jenis_pekerjaan);
            $("#addtext").val(data.keterangan);
            $("#update_id").val(data.id_penduduk);
          },
          error: function(error) {
            console.error("Ajax request failed: ", error);
          }
        });
      }

      function showData(id) {
        $('#showmodal').modal('show');

        $.ajax({
          type: "POST",
          url: "getshowdata.php",
          data: {
            id: id
          },
          dataType: "json",
          success: function(data) {
            console.log(data);
            $("#showname").val(data.nama);
            $("#showprovince").val(data.provinsi);
            $("#showregency").val(data.kabupaten);
            $("#showsubdistrict").val(data.kecamatan);
            $("#showaddress").val(data.alamat);
            $("#showphone").val(data.telp);
            $("#showdate_birth").val(data.tgl_lahir);
            $("#showold").val(data.usia);
            $("#showsellery").val(data.pendapatan);
            $("#showeducation").val(data.tingkat_pendidikan);
            $("#showwork").val(data.jenis_pekerjaan);
            $("#showaddtext").val(data.keterangan);
          },
          error: function(error) {
            console.error("Ajax request failed: ", error);
          }
        });
      }

      function confirmDelete(id) {
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
          window.location.href = "hapusdatapenduduk.php?id=" + id;
        } else {
          console.log("Delete canceled.");
        }
      }
    </script>
</body>

</html>