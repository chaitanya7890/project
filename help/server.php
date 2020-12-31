<?php
session_start();
//require_once('PHPMailer/PHPMailerAutoload.php');

// initializing variables
$name="";
$username = "";
$email    = "";
$phonenumber="";
$location="";
$gender="";
$work="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'helpinghand');//server,username,password,databasenname

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $name=mysqli_real_escape_string($db,$_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $phonenumber=mysqli_real_escape_string($db,$_POST['phonenumber']);
  $location=mysqli_real_escape_string($db,$_POST['location']);
  if (isset($_POST['gender']))
  {
  $gender=$_POST['gender'];
  }
  $work=$_POST['work'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if(empty($name)){array_push($errors,"name is required");}
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");}
  if(empty($phonenumber)){array_push($errors,"Phonenumber is required");}  
  if(empty($gender)){array_push($errors,'gender is required');}
  if(empty($work)){array_push($errors,'work is required');}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);//mysqli_query('dbconnection','query')
  $user = mysqli_fetch_assoc($result);
  //array => {[0]=>value of id,[1]=>value of username,[2]=>value of email,[3]=>value of password}
  //associcate array {[id]=>value of id,[username]=>valueof username}

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");

      
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO register(name,username, email, password,phonenumber,location,gender,work) 
  			  VALUES('$name','$username', '$email', '$password','$phonenumber','$location','$gender','$work')";
    mysqli_query($db, $query);
    
   /* $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'ssl://smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'testphpvinod@gmail.com';
    $mail->Password = 'Qwerty@123';
    $mail->SetFrom('testphpvinod@gmail.com','Test PHP');
    $mail->Subject = "Your Registration Successful";
    $mail->Body = '<h3 style="color:blue">Hello '.$username.'</h3></br>You have succesfully registered';


    $mail->AddAddress($email);
    $result = $mail->Send();

    // if($result == 1){
    //     echo "OK Message";
    // }
    // else{
    //     echo "Sorry. Failure Message";
    // }*/
    
  	$_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM register WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
        
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

  ?>