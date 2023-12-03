<?php
include "templates/header.php";
?>

<!-- pages -->
<?php
if (isset($_GET['crud'])) {
  include "pages/crud.php";
} else if (isset($_GET['rekap'])) {
  include "pages/rekap.php";
} else {
  include "pages/list.php";
}
?>
<!-- akhir pages -->

<?php
include "templates/footer.php";
?>