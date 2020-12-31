<?php
//session_start();
$donate="";
$description = "";
$quantity="";
$email    = "";
$phonenumber="";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'helpinghand');//server,username,password,databasenname

if (isset($_POST['don_vol'])) {

$donate=$_POST['donate'];
$description=mysqli_real_escape_string($db,$_POST['description']);
$quantity=mysqli_real_escape_string($db,$_POST['quantity']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$phonenumber=mysqli_real_escape_string($db,$_POST['phonenumber']);

if(empty($donate)){array_push($errors,"donation is required");}
  if (empty($description)) { array_push($errors, "Description is required"); }
  if (empty($quantity)) { array_push($errors, "quantity is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phonenumber)) { array_push($errors, "Phonenumber is required"); }

  if (count($errors) == 0) {

  $query = "INSERT INTO donation(donate,description,quantity, email,phonenumber) 
  			  VALUES('$donate','$description','$quantity', '$email','$phonenumber')";
    mysqli_query($db, $query);
    $_SESSION['email'] = $email;
	echo   $_SESSION['email'];
    $_SESSION['description'] = $description;


  }
}

?>

