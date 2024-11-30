<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
<div class="box round first grid">
<h2>User List</h2>
<?php
// //delete query code 
if(isset($_GET['delUser'])){
 $deluser = $_GET['delUser'];
 $delquery = "DELETE FROM tbl_user WHERE id ='$deluser'";
 $delUser = $db->delete($delquery);
 if ($delUser) {
		echo "<span class='success'>User Deleted Successfully!!</span>";
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
			<th>User Name</th>
			<th>Email</th>
			<th>Details</th>
			<th>Role</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

<?php
  $query = "SELECT * FROM tbl_user ORDER BY id DESC";
  $user = $db->select($query);
 if ($user) {
	 $i = 0;
	  while($data = $user->fetch_assoc()) {
      $i++;
?>
		<tr class="odd gradeX">
			<td><?php echo $i?></td>
			<td><?php echo $data['username']?></td>
			<td><?php echo $data['email']?></td>
			<td><?php echo $data['details']?></td>
			<td><?php 
             if ($data['role'] == '0') {
                  echo "Admin";
             }elseif($data['role'] == '1') {
               echo "Author";
             }elseif($data['role'] == '2') {
                 echo "Editor";
             }
            ?></td>

			<td>
			<a href="viewUser.php?userId=<?php echo $data['id']?>">View</a> ||
			<a onclick="return confirm('Do You Want To Delete this User?')" href="?delUser=<?php echo $data['id']?>">Delete</a></td>
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
