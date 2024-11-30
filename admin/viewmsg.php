<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!isset($_GET['msgid'])  || $_GET['msgid'] == NULL) {
    echo "<script>window.location = 'inbox.php'; </script>";  
	// header("Location: catlist.php");
 }else {
   $msgid = $_GET['msgid'];
 }
?>
<div class="grid_10">
<div class="box round first grid">
<h2>Inbox Message</h2>
<div class="block">               
    <form action="" method="POST" enctype="multipart/form-data">
    <?php
  $query = "SELECT * FROM tbl_contact WHERE id='$msgid'";
  $showMsg = $db->select($query);
 if ($showMsg) {
	  while($result = $showMsg->fetch_assoc()) {
    
?> 
    <table class="form">    
        <tr>
            <td>
                <label>Name</label>
            </td>
            <td>
                <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
            </td>
            <td>
                <input type="text" value="<?php echo $result['email']; ?>"class="medium" />
            </td>
        </tr>
        <tr>
        <tr>
            <td>
                <label>Message</label>
            </td>
            <td>
                <textarea class="tinymce" name="body">
                <?php echo $result['body']; ?>
                </textarea>
            </td>
        </tr>
        <td>
                <label>Date</label>
            </td>
            <td>
                <input type="text" value="<?php echo $fm->formaDate($result['date'] )?>" class="medium"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" onclick="history.go(-1);" name="submit" Value="Go Back" />
            </td>
        </tr>
    </table>
	<?php } } ?>

    </form>
</div>
</div>
</div>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
setupTinyMCE();
setDatePicker('date-picker');
$('input[type="checkbox"]').fancybutton();
$('input[type="radio"]').fancybutton();
});
</script>
<script type="text/javascript">
$(document).ready(function () {
setupLeftMenu();
setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>

