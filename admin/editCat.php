<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  
 if (!isset($_GET['catid'])  || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php'; </script>";  
	// header("Location: catlist.php");
 }else {
   $id = $_GET['catid'];
 }
?>
<div class="grid_10">
<div class="box round first grid">
    <h2>Update Category</h2>
    <div class="block copyblock"> 
<?php
//updated query 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $fm->validation($_POST['name']);
	$name = mysqli_real_escape_string($db->link, $name);
    if (empty($name)) {
      echo "<span class='error'>Filed Must Not be Empty!!</span>";
    } else {
        $query = "UPDATE tbl_category SET 
        name = '$name'
         WHERE id='$id' ";

        $updateCat = $db->update($query);
        if ($updateCat) {
            echo "<span class='success'>Category Updated Successfully!!</span>";
   } else{
      echo "<span class='error'>Something went wrong Please try again !!</span>";
 }
    }
}
?>
<?php
 $query = "SELECT * FROM tbl_category WHERE id='$id' ORDER BY id DESC";
 $category = $db->select($query);
 if ($category) {
     while ($data = $category->fetch_assoc()){
  
?>
<form action=""  method="POST" enctype="multipart/form">
<table class="form">					
    <tr>
        <td>
            <input type="text" name="name" value="<?php echo $data['name'] ?>" class="medium" />
        </td>
    </tr>
    <tr> 
        <td>
            <input type="submit" name="submit" Value="Save" />
        </td>
    </tr>
</table>
</form>
<?php } }?>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>

