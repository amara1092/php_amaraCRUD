<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'php_amaracrud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$username = '';
$password = '';

if(isset($_POST['save']))
{ 
$username = $_POST['username'];
$password = $_POST['password'];

$mysqli->query("INSERT INTO data (username, password) VALUES ('$username','$password')") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("password: userslist.php");

}

if(isset($_GET['delete']))
{
$id = $_GET['delete'];
$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

$_SESSION['message'] = "Record has been deleted";
$_SESSION['msg_type'] = "danger";

header("password: userslist.php"); 

}


if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
  if(count($result)==1){
      $row = $result->fetch_array();
      $username = $row['username'];
      $password = $row['password'];
  }
}

if(isset($_POST['update'])){
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

$mysqli->query("UPDATE data SET username='username', password='$password' WHERE id=$id") or die($mysqli->error);

$_SESSION['message'] = "Record has been updated";
$_SESSION['msg_type'] = "warning";

header("password: userslist.php");

}
