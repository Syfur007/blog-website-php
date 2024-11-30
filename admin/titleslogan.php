<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">

<div class="box round first grid">
<h2>Update Site Title and Description</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $title = $fm->validation($_POST['title']);
     $slogan = $fm->validation($_POST['slogan']);

    $title = mysqli_real_escape_string($db->link, $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);
    
//Image validation
$permited  = array('jpg', 'jpeg', 'png', 'gif');
$file_name = $_FILES['logo']['name'];
$file_size = $_FILES['logo']['size'];
$file_temp = $_FILES['logo']['tmp_name'];

$div = explode('.', $file_name);
$file_ext = strtolower(end($div));
$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
//upload is a folder on my admin directory
$uploaded_image = "upload/".$unique_image;
//before upload any content checking if they are empty or not
 if ($title == "" || $slogan == ""){
  echo "<span class='error'>Filed Must Not be Empty!!</span>";     
 } else {   
if(!empty($file_name)){         
   if ($file_size >5048567) {
    echo "<span class='error'>Image Size should be less then 5MB! </span>";

   } elseif (in_array($file_ext, $permited) === false) {
 echo "<span class='error'>You can upload only:-" .implode(', ', $permited)."</span>";
 } else{
 //uploaing image in upload folder 
    move_uploaded_file($file_temp, $uploaded_image); 
//update content into database 
$query = "UPDATE title_slogan SET
           
          title = '$title',
          slogan = '$slogan',
          logo = '$uploaded_image'
          WHERE id ='1'";

   $update_row = $db->update($query);
   if ($update_row) {
    echo "<span class='success'>Post Updated Successfully.</span>";
   }else {
    echo "<span class='error'>Post Not Updated !</span>";
   }
}       
}else {
        $query = "UPDATE title_slogan SET
          title = '$title',
          slogan = '$slogan'
          WHERE id ='1'";

    $update_row = $db->update($query);
    if ($update_row) {
    echo "<span class='success'>Post Updated Successfully.
    </span>";
    }else {
    echo "<span class='error'>Post Not Updated !</span>";
    }
}   
}
}
?>


<?php
 $query = "SELECT * FROM title_slogan WHERE id=1";
 $blog_title = $db->select($query);
 if ($blog_title) {
   while ($result = $blog_title->fetch_assoc()){
 ?>

<div class="block sloginblock">               
<form action="" method="post" enctype="multipart/form-data">
<table class="form">					
    <tr>
        <td>
            <label>Website Title</label>
        </td>
        <td>
            <input type="text" value='<?php echo $result['title'] ?>' name="title" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Website Slogan</label>
        </td>
        <td>
            <input type="text" value='<?php echo $result['slogan'] ?>' name="slogan" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label></label>
        </td>
        <td>
        <img src="<?php echo $result['logo']?>" alt="logo" height="200px" width="200px">
          
        </td>
    </tr>
    <tr>
            <td>
                <label>Upload logo</label>
            </td>
            <td>
                <input type="file" name="logo"/>
            </td>
        </tr>

    
        <tr>
        <td>
        </td>
        <td>
            <input type="submit" name="submit" Value="Update" />
        </td>
    </tr>
</table>
</form>
        
</div>
 <?php } } ?> <!-- end while loop -->
</div>

<?php include 'inc/footer.php';?>