<?php include 'inc/header.php'; ?>
<div class="contentsection contemplete clear">
<?php  
 if (!isset($_GET['pageid'])  || $_GET['pageid'] == NULL) {
    echo "<script>window.location = 'index.php'; </script>";  
 }else {
   $pageid = $_GET['pageid'];
 }
?>
	<?php
            $pagequery = "SELECT * FROM tbl_page WHERE id = '$pageid'";
            $detailspage = $db->select($pagequery);
            if ($detailspage) {
            while ($result = $detailspage->fetch_assoc()){   ?>  
<div class="maincontent clear">
	<div class="about">
 	<h2><?php echo $result['name']?></h2>
    
 <p><?php echo $result['body']?></p>
 
</div>
</div>
<?php  } } else { header("location:404.php"); } ?>
<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
			<ul>
				<li><a href="#">Category One</a></li>
				<li><a href="#">Category Two</a></li>
				<li><a href="#">Category Three</a></li>
				<li><a href="#">Category Four</a></li>
				<li><a href="#">Category Five</a></li>						
			</ul>
	</div>
</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>