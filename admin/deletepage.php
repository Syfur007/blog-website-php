<?php include '../lib/session.php';
  Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>

<?php
  $db = new Database();
 ?>
 <?php
    if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
      "<script>window.location = 'index.php'; </script>";  
    } else {
      $pageid = $_GET['delpage'];
      $query = "DELETE FROM tbl_page WHERE id = '$pageid'";
          $delpage = $db->delete($query);
             if ($delpage) {
                  echo "<script>alert('page Deleted Successfully!');</script>";
                  echo "<script>window.location = 'index.php'; </script>";  

             }else {
               echo " Data Not deleted.";
              header("location:index.php");
          }
    }

  ?>
