<html>
<!-- the head section -->
<head>
    <title>Welcome</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<!-- the body section -->
<body>
    <?php require_once 'process.php'; ?>

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
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error); 
//pre_r($result);
?>

<a href="admin.php"  type= "submit" class="btn btn-dark" name="save">Login</a>
<a href="register.php"  type= "submit" class="btn btn-dark" name="save">Register</a>
<?php include './includes/Signup_header.php';?>
<?php require_once 'process.php'; ?>
<b>
<center>
<p>Give Us some information your about your self</p>
</center>
</b>
    <div class= "row justify-content-center ">
    <form action="process.php" method="POST">
    <input type="hidden" name= "id" value= "<?php echo $id; ?>"
       <div class= "form-group"> 
        <label>Name</label>
        <input type="text" name="name" class= "form-control" 
        value="<?php echo $name; ?>" placeholder= "Enter your name"  pattern="[A-Za-z].{2,}" required>
        </div>

        <div class= "form-group"> 
        <label>Location(PostCode)</label>
        <input type="text " name="location" class= "form-control" 
        value="<?php echo $location; ?>" placeholder= "Enter your location" pattern=".{2,}" title="Eight or more characters" required>
        </div>

        <div class= "form-group"> 
        <center>
        <?php
        if ($update == true):
            ?>
             <button type= "submit" class="btn btn-primary" name="save">Update</button>
        <?php else: ?>
        <button type= "submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
        </center>
        
    </div>
        <div class= "form-group"> 
        <center>
        <a href="index.php"  type= "submit" class="btn btn-dark" name="save">Welcome</a>
        </center>
        </div>
        <div class= "form-group"> 

        </div>
       
       
       
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
    <th>Name</th>
    <th>Location</th>
    <th colspan="2">Action</th>
</tr>
</thead>

<?php
while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['location']; ?></td>
    <td>
    <a href="welcome.php?edit=<?php echo $row['id']; ?>"
    class="btn btn-info">Edit</a>
    <a href="welcome.php?delete=<?php echo $row['id']; ?>"
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