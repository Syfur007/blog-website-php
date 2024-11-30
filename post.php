<?php include 'inc/header.php'; ?>
<?php  
//getting id from index.php page from redmore class
 if (!isset($_GET['id'])  || $_GET['id'] == NULL) {
	header("Location: 404.php");
 }else {
   $id = $_GET['id'];
 }
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
<?php
$query = "SELECT * FROM tbl_post where id='$id'";
   $post = $db->select($query);
   if ($post) {
	   while($result = $post->fetch_assoc()) {
?>
<h2><?php echo $result['title'] ?></h2>
				
<h4><?php echo $fm->formaDate($result['date'] ) ?> By 
<a href="#"><?php echo $result['author'] ?></a></h4>

<img src="admin/<?php echo $result['image']?>" alt="post image"> 
	
<p> <?php echo $fm->textShroten($result['body'] ) ?></p>
							
<div class="relatedpost clear">
<?php 
 $catid = $result['cat'];
 $queryreleted = "SELECT * FROM tbl_post where cat='$catid' limit 6";
 $reletedpost = $db->select($query);
 if ($reletedpost) {
	 while($rresult = $reletedpost->fetch_assoc()) {
?>
	<h2>Related articles</h2>
	<a href="post.php?id=<?php echo $rresult['id'] ?>">
	<img src="admin/<?php echo $rresult['image']?>" alt="post image"/></a>

<?php }  } else {  echo "No Related articles"; } ?>
 
</div>
<?php  } } else { header("location:404.php"); } ?>

</div>
</div>


<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php';  ?>