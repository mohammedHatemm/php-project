<?php
require_once "connection.php";

if(isset($_POST["registerBtn"]))
{
  $userName = $_POST["username"] ?? null;
  $userPassword = $_POST["userpassword"] ?? null;
  $userEmail = $_POST["useremail"] ?? null;
  $userPhone = $_POST["userphone"] ?? null;
  $encryptedPassword = md5($userpassword);



  $checkEmail = "SELECT * FROM users WHERE email = '$useremail'";
  $statment = $pdo->prepare($checkEmail);
  $statment->execute();
  $result = $statment->fetch(PDO::FETCH_ASSOC);

  if($result)
  {
    header("location: ./register.php?message=Email already exist");
    exit();
  }
  $namePattern = "/^[a-zA-Z ]{3,}$/";
  // $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA


if(!preg_match($namePattern , $userName))
{
  header("location: ./register.php?message=Invalid username,
  please enter a name with at least 3 characters");
  exit();
}

if(!filter_var($userEmail , FILTER_VALIDATE_EMAIL))
{
  header("location: ./register.php?message=your email is incorrect ,
  check your email and try again");
  exit();
}




$passwordPattern="/^[1-9]{5,}$/";
if(!preg_match($passwordPattern , $userPassword))
{
  header("location: ./register.php?message=Invalid password ,
  please enter a password with at least 5 numbers");
  exit();
}

$query = "insert into users(username ,userpassword , useremail ,
userphone ) values('$userName' , '$userPassword' ,  '$userEmail' ,
'$userPhone')";
$statment = $pdo->prepare($query);
$statment->execute();
header("location:./login.php?massage=your account created successfully");
 exit();


}


// login button click => ./profile.php

if (isset($_POST["btnLogin"]))
{
  $userEmail = $_POST["useremail"];
  $userPassword = $_POST["userpassword"];
  $encryptedPassword = md5($userPassword);
  $query = "select * from users where useremail = '$userEmail' and userpassword = '$encryptedPassword'";
$statment = $pdo->prepare($query);
$statment->execute();
$statment->setFetchMode(PDO::FETCH_ASSOC);


if($result)
{
  header("location:./profile.php");
  exit();
}
else
{
  header("location:./login.php?message=Invalid email or password ,
  please try again");
  exit();
  
}
}
