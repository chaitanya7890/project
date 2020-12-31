<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: donorlogin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: help.php");
  }

?>
<?php include('homeserver.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<nav>
<label class="logo" >Donor page</label>

<ul>
<li><a href='donorprofile.php'>Profile</a></li>
<?php  if (isset($_SESSION['username'])) : ?>
<li><a href="home.php?logout='1'">Logout</a></li>

<?php endif ?>

</ul>
</nav>

<?php  if (isset($_SESSION['username'])) : ?>
    	<p style="text-align:center;font-size:50px">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<?php endif ?>

<form method="post" action="home.php" >

<?php include('errors.php'); ?>



<label>Donate </label>
      <select name="donate">
        <option value="">--Select--</option>
        <option value="books">Books</option>
        <option value="stationary">Stationary</option>
        <option value="clothes">Clothes</option>
        </select>

		<div class="input-group">
      <label>Description</label>
	  
         <textarea rows = "5" cols = "50" name = "description" value="<?php echo $description;?>">
            Enter details here...
         </textarea><br>

     <!-- <input type="text" name="description" value="<?php //echo $description; ?>">-->
    </div>
    <div class="input-group">
      <label>Quantity</label>
      <input type="text" name="quantity" value="<?php echo $quantity; ?>">
    
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>PhoneNumber</label>
      <input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>">
      </div>
      </div>
    <div class="input-group">
      <button type="submit" class="btn" name="don_vol">Submit</button>
    </div>
</form>		
		
</body>
</html>