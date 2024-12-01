<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
<div class="box round first grid">
<h2>Post List</h2>
<div class="block">  
	<table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>NO</th>
			<th> Title</th>
			<th> Description</th>
			<th> Image</th>
			<th> Author</th>
			<th> Tags</th>
			<th> Date</th>
			<th rowspan="2">Action</th>	 
		</tr>
	</thead>
	<tbody>
<?php
//join two table 
 $query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post 
    INNER JOIN tbl_category 
    ON tbl_post.cat = tbl_category.id
    ORDER BY tbl_post.title DESC";

 $post = $db->select($query);
  if ($post) {
	 $i = 0;
    while($result = $post->fetch_assoc()) {
    $i ++;
?>

<tr class="odd gradeX">
	<td><?php echo $i; ?></td>
	<td><?php echo $result['title']; ?></td>
	<td> <?php echo $fm->textShroten($result['body'],60 ) ?></td>
	<td>
<img src="<?php echo $result['image']?>"  width="80px"/></a>
</td>	

	<td> <?php echo $result['author'] ?> </td>
	<td><?php echo $result['tag']; ?></td>
	<td><?php echo $fm->formaDate($result['date'] ) ?></td>
<?php
if (Session::get('userId') == $result['userid'] || Session::get('userRole') == '0') {?>
  	<td><a href="editpost.php?editpostid=<?php echo $result['id'] ?>">Edit</a> ||
	 	<td><a  onclick="return confirm('Are you sure you want to delete this post?')" href="deletepost.php?delpostid=<?php echo $result['id'] ?>">Delete</a> ||
	 <?php  }?>

</tr>
		 <?php } }?>
	
	</tbody>
</table>

</div>
</div>
</div>


<?php include 'inc/footer.php';?>


<script type="text/javascript">
$(document).ready(function () {
setupLeftMenu();
$('.datatable').dataTable();
setSidebarHeight();
});
</script>
