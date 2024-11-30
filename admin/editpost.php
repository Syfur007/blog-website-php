<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
<?php  
//geting editpost id from postlist.php
 if (!isset($_GET['editpostid'])  || $_GET['editpostid'] == NULL) {
    echo "<script>window.location = 'postlist.php'; </script>";  
	// header("Location: postlist.php");
 }else {
   $postid = $_GET['editpostid'];
 }
?>
<div class="box round first grid">
<h2>Update  Post</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = mysqli_real_escape_string($db->link, ($_POST['title']));
    $cat = mysqli_real_escape_string($db->link, ($_POST['cat']));
    $body = mysqli_real_escape_string($db->link, ($_POST['body']));
    $author = mysqli_real_escape_string($db->link, ($_POST['author']));
    $tag = mysqli_real_escape_string($db->link, ($_POST['tag']));
    $userid = mysqli_real_escape_string($db->link, ($_POST['userid']));
    
//Image validation
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    //upload is a folder on my admin directory
    $uploaded_image = "upload/".$unique_image;
 //before upload any content checking if they are empty or not
     if ($title == "" || $cat == "" || $body == "" || $author == "" || $tag == ""){
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
   $query = "UPDATE tbl_post SET
              cat = '$cat',
              title = '$title',
              body = '$body',
              image = '$uploaded_image',
              author = '$author',
              tag = '$tag',
              userid = '$userid'
             WHERE id ='$postid' ";

       $update_row = $db->update($query);
       if ($update_row) {
        echo "<span class='success'>Post Updated Successfully.</span>";
       }else {
        echo "<span class='error'>Post Not Updated !</span>";
       }
    }       
   }else {
            $query = "UPDATE tbl_post SET
            cat = '$cat',
            title = '$title',
            body = '$body',
            author = '$author',
            tag = '$tag',
            userid = '$userid'
            WHERE id ='$postid'";

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

<div class="block">     
    <?php 
    $query = "SELECT * FROM tbl_post WHERE id='$postid' ORDER BY id DESC";
    $postedit = $db->select($query);
    if($postedit){
        while($result = $postedit->fetch_assoc()){
  
  ?>          
    <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">
        
        <tr>
            <td>
                <label>Title</label>
            </td>
            <td>
                <input type="text" name="title" value="<?php echo $result['title']?>"/>
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Category</label>
            </td>
           
            <td>
          
<select id="select" name="cat">
    <option value="select category">Select Category</option>
    
    <?php  
        $query =  "SELECT * FROM tbl_category";
            $category = $db->select($query);
            if ($category ) {
            while ($data = $category->fetch_assoc()) {
      ?>
    <option 
    <?php  if($result['cat'] == $data['id']){ ?>
        selected="selected"
       <?php } ?> 

    value="<?php echo $data['id']; ?>">
    <?php echo $data['name']; ?></option>

<?php } } //end while loop ?>

</select>
       <tr>
            <td>
                <label>Upload Image</label>
            </td>
            <td>
                <img src="<?php echo $result['image']?>" width="100px" alt="no image"> <br>
                <input type="file" name="image"/> 
            </td>
        </tr> 
        <tr>
            <td style="vertical-align: top; padding-top: 9px;">
                <label>Content</label>
            </td>
            <td>
                <textarea class="tinymce" name="body">
                <?php echo $result['body']?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label>Tags</label>
            </td>
            <td>
                <input type="text" name="tag"  value="<?php echo $result['tag']?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Author</label>
            </td>
            <td> 
                <input type="text" name="author" value="<?php echo $result['author']?>" class="medium" />
                <input type="hidden"  name="userid" value="<?php echo Session::get('userId')?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" Value="Save" />
            </td>
        </tr>
    </table>
    </form>
    <?php } } ?>
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

