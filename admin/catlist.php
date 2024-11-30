<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
<div class="box round first grid">
<h2>Category List</h2>
<?php
//delete query code 
if(isset($_GET['delcat'])){
 $delid = $_GET['delcat'];
 $delquery = "DELETE FROM tbl_category WHERE id ='$delid'";
 $delData = $db->delete($delquery);
 if ($delData) {
		echo "<span class='success'>Category Deleted Successfully!!</span>";
} else{
  echo "<span class='error'>Something went wrong Please try again !!</span>";
}
}
?>
<div class="block">        
	<table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>Serial No.</th>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

<?php
  $query = "SELECT * FROM tbl_category  ORDER BY id DESC";
  $category = $db->select($query);
 if ($category) {
	 $i = 0;
	  while($data = $category->fetch_assoc()) {
      $i++;
?>
		<tr class="odd gradeX">
			<td><?php echo $i?></td>
			<td><?php echo $data['name']?></td>
			<td>
			<a href="editCat.php?catid=<?php echo $data['id']?>">Edit</a> ||
			<a onclick="return confirm('Do You Want To Delete this?')" href="?delcat=<?php echo $data['id']?>">Delete</a></td>
		</tr>
	<?php }  }// end while loop  ?>
</tbody>
</table>
</div>
</div>
</div>


<script type="text/javascript">

$(document).ready(function () {
setupLeftMenu();

$('.datatable').dataTable();
setSidebarHeight();

});
</script>
<?php include 'inc/footer.php'?>
