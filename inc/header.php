<?php 
 include 'lib/Database.php';
 include 'config/config.php';
 include 'helpers/Format.php';
?>
<!-- I am creating objects here so that i can access it from any page, becuase header is includeded in every page -->
<?php
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	//showing title dynamically
	  if (isset($_GET['pageid'])) {
		  $pageTitle = $_GET['pageid'];
		  $query = "SELECT * FROM tbl_page WHERE id = '$pageTitle'";
		  $gettitle = $db->select($query);
		  if ($gettitle) {
         while ($result = $gettitle->fetch_assoc()) {  ?>

	<title><?php echo $result['name']?> - <?php echo TITLE?></title>

	 <?php  } }  } elseif (isset($_GET['id'])) {
		  $postid = $_GET['id'];
		  $query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		  $postID = $db->select($query);
		  if ($postID) {
         while ($result = $postID->fetch_assoc()) {  ?>

	<title><?php echo $result['title']?> - <?php echo TITLE?></title>

	 <?php  } }   }else{ ?>
	 
		 	<title><?php echo $fm->title() ?> - <?php echo TITLE?></title>
		 <?php } ?>		 
	
	<link rel="icon" href="images/fav.png" type="image/x-icon">
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Syfur">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
<?php
 $query = "SELECT * FROM title_slogan WHERE id = 1";
 $getData = $db->select($query);
 if ($getData) {
	while ($result = $getData->fetch_assoc()) {
?>		
	<a href="#">
		<div class="logo">
			<img src="admin/<?php echo $result['logo'] ?>" alt="Logo"/>
			<h2><?php echo $result['title'] ?></h2>
			<p><?php echo $result['slogan'] ?></p>
		</div>
	</a>

<?php } }?>
	<div class="social clear">
<?php
$query = "SELECT * FROM tbl_social WHERE id = 1";
$getSocial = $db->select($query);
if ($getSocial) {
	while ($data = $getSocial->fetch_assoc()) {
?>
<div class="icon clear">
<a href="<?php echo $data['fb']?>" target="_blank"><i class="fa fa-facebook"></i></a>
<a href="<?php echo $data['tw']?>" target="_blank"><i class="fa fa-twitter"></i></a>
<a href="<?php echo $data['ln']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
<a href="<?php echo $data['gp']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
</div>
<?php } }?>

		<div class="searchbtn clear">
		<form action="search.php" method="get">
			<input type="text" name="search" placeholder="Search keyword..."/>
			<input type="submit" name="submit" value="Search"/>
		</form>
		</div>
	</div>
</div>
<div class="navsection templete">
	<?php //	highlight current page or menu item	
	  $path = $_SERVER['SCRIPT_FILENAME'];
	  $currentPage = basename($path,  '.php');
	?>
<ul>
	<li><a
	 <?php  if ($currentPage == 'index') {	echo 'id="active"';}?>
	 	href="index.php">Home</a></li>
	<?php
		$query = "SELECT * FROM tbl_page";
		$pages = $db->select($query);
		if ($pages) {
		while ($result = $pages->fetch_assoc()){   ?>  
		<li><a
		<?php
//	highlight current page or menu item		 
  if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
	 echo 'id="active"';
  }
	?>
		href="page.php?pageid=<?php echo $result['id']?>"><?php echo $result['name']?></a></li>

		<?php }  } ?>
	<li><a
	<?php  if ($currentPage == 'contact') {	echo 'id="active"';}?>
	href="contact.php">Contact</a></li>
</ul>
</div>
