<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">

<div class="box round first grid">
<h2>Update Copyright Text</h2>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $note = $fm->validation($_POST['note']);
   	$note = mysqli_real_escape_string($db->link, $note);
 
    if (empty($note)){
      echo "<span class='error'>Filed Must Not be Empty!!</span>";
    } else {
        $query = "UPDATE tbl_footer SET 
         note = '$note'
           WHERE id='1'";

        $footer = $db->update($query);
        if ($footer) {
            echo "<span class='success'>Footer Updated Successfully!!</span>";
   } else{
      echo "<span class='error'>Something went wrong Please try again !!</span>";
 }
    }
}
?>
<div class="block copyblock"> 
<?php
 $query = "SELECT * FROM tbl_footer WHERE id=1";
 $footerNote = $db->select($query);
 if ($footerNote) {
   while ($result = $footerNote->fetch_assoc()){
 ?>  
    <form action="" method="post" enctype="multipart/form">
    <table class="form">					
        <tr>
            <td>
                <input type="text" value="<?php echo $result['note'] ?>" name="note" class="large" />
            </td>
        </tr>
        
            <tr> 
            <td>
                <input type="submit" name="submit" Value="Update" />
            </td>
        </tr>
    </table>
    </form>
    <?php } } ?>
</div>
</div>
</div>

<?php include 'inc/footer.php';?>
