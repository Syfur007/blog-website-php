<?php include '../lib/session.php';
  Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>


<?php

  $db = new Database();


 ?>
 <?php
    if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL) {
         header("location:postlist.php");
    } else {
      $postid = $_GET['delpostid'];


      
      $query = "select * from tbl_post where id = '$postid'";
      $getdata = $db->select($query);
      if ($getdata) {
          while ($delimg = $getdata->fetch_assoc()) {
               $dellink = $delimg['image'];
               //delete image from directory folder with unlink
               unlink($dellink);
          }
      }
             $delquery = "delete from tbl_post where id = '$postid'";
             $deldata = $db->delete($delquery);
             if ($deldata) {
                  echo "<script>alert('Post Deleted Successfully!');</script>";
                  echo "<script>window.location = 'postlist.php'; </script>";  

             }else {
               echo " Data Not deleted.";
              header("location:postlist.php");
          }
    }

  ?>
