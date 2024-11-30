<?php 
 include '../lib/Database.php';
 include '../config/config.php';
 include '../helpers/Format.php';
?>
<?php 
include '../lib/Session.php';
Session:: checkLogin();
?>

<!-- I am creating objects here so that i can access it from any page, becuase header is includeded in every page -->
<?php
$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recover</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
 <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $fm->validation($_POST['email']);
      $email = mysqli_real_escape_string($db->link, $email);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class='error'>Invalid Emal Address!!</span>";
  } else {
      //checking exixting email addresses
      $query = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
      $mailCheck = $db->select($query);
      if ($mailCheck != false) {
          while ($value = $mailCheck->fetch_assoc());
          $userid = $value['id'];
          $username = $value['username'];
      }
      $txt = substr($email, 0, 3);
      $rand = rand(10000, 99999);
      $newpass = "$txt$rand";
      
      $query = "UPDATE tbl_user SET 
       password = '$newpass'
       WHERE id='$userid'";

       $updatePass = $db->update($query);
      if ($updatePass) {

        $to = "$email";
        $from = "anowarjr@gmail.com";
        $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
         $subject = "Your Password: ";
        $message = "Your username is ".$username."and your Password is ".$newpass;

        $sendmail = mail($to, $subject, $message, $headers);
        if ($sendmail) {
        echo "<span class='success'>Please Check your email for new password<span>";  
   }else{
    echo "<span class='error'>SOmething went wrong</span>!!</span>"; 

   }
  }else{
    echo "<span class='error'>Email does not exist!!</span>"; 

  }
 }
}
 ?>
 
 <form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Enter your Email Address"  name="email"/>
			</div>
			 
			<div>
				<input type="submit" value="send mail"/>
			</div>
		</form><!-- form -->
		<div class="button">
		 <a href="login.php">Login </a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>