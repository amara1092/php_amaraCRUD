<html>
<!-- the head section -->
<head>
    <title>Users</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<!-- the body section -->
<body>
    <?php require_once 'Uselistprocess.php'; ?>

<?php  

if(isset($_SESSION['message'])):?>

<div class = "alert alert-<?=$_SESSION['msg_type']?>">
<?php
 echo $_SESSION['message'];
 unset($_SESSION['message']);

 ?>
<?php endif ?>
    <div class="container">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'php_amaracrud') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM admin") or die($mysqli->error); 
//pre_r($result);
?>


<<?php include './includes/Manager_Header.php';?>
<a href="http://localhost/php_amaraCRUD/?category_id=1" class="btn " role="button">Hoodies </a>
<a href="http://localhost/php_amaraCRUD/?category_id=2" class="btn " role="button">T-shirt </a>
<a href="http://localhost/php_amaraCRUD/?category_id=3" class="btn " role="button">Bottoms </a>
<a href="http://localhost/php_amaraCRUD/?category_id=4" class="btn " role="button">Jackets & Coats</a>
<a href="http://localhost/php_amaraCRUD/?category_id=5" class="btn " role="button">Tracksuits</a>
<a href="admin.php" class="btn btn-outline-danger" role="button">Sign Out</a>
<a href="index.php" class="btn btn-outline-warning" role="button">Switch</a>
<a href="userslist.php" class="btn btn-outline-warning" role="button">Display List of Users</a>
<?php require_once 'Uselistprocess.php'; ?>
<b>

       
    </form>
    <div>
    <div>
    <center>
<h2>List of Users and There Locations </h2>
<h2>____________________________________</h2>
</center>
<div class= "row justify-content-center ">
<table class="table">
<thead>
<tr>
    <th>Username</th>
    <th colspan=1>Action</th>
</tr>
</thead>

<?php
while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['username']; ?></td>
    <td>
    <a href="userslist.php?edit=<?php echo $row['id']; ?>"
    class="btn btn-info">Edit</a>
    <a href="userslist.php?delete=<?php echo $row['id']; ?>"
    class="btn btn-danger">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table> 
</div>
<?php

function pre_r( $array )
{
echo '<pre>';
print_r($array);
echo '</pre>';
}
?>

</body>