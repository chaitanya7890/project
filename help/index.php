<?php 

  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: help.php");
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<nav>
<label class="logo" >Volunteer page</label>

<ul>
<li><a href='profile.php'>Profile</a></li>
<?php  if (isset($_SESSION['username'])) : ?>
<li><a href="index.php?logout='1'">Logout</a></li>

<?php endif ?>

</ul>
</nav>

<?php  if (isset($_SESSION['username'])) : ?>
    	<p style="text-align:center;font-size:50px">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<?php endif ?>
		
<form action="" method="post">
<?php
include "homeserver.php";
//$_SESSION['description'] = $description;
?>
<?php
	

	$q=mysqli_query($db,"SELECT * FROM donation where email= '$_SESSION[email]';");
	$row=mysqli_fetch_assoc($q);
?>
<h4>Donate:<?php echo $row['donate']?></h4>
<h4>Description:<?php echo $row['description']?></h4>
<h4>Quantity:<?php echo $row['quantity']?></h4>
<h4>Email:<?php echo $row['email']?></h4>
<h4>Phonenumber:<?php echo $row['phonenumber']?></h4>
</body>
</html>