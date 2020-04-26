<?php

//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'lib/password.php';

/**
 * Include our MySQL connection.
 */
require 'connect.php';


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our admin table.
    $sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
    }
    
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./styles/register.css">
</head>
<body>

<form action="register.php" style="border:1px solid #ccc" method="post">
  <div class="container">
  <?php include './includes/Signup_header.php';?>
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username"  pattern="[A-Za-z].{3,}" required>

    <label for="password"><b>Password</b></label>
    <input type="password" id="myInput" placeholder="Enter Password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <hr>
    <p>By creating an account you agree to our <a href="form.php">Terms & Privacy</a>.</p>
<center>
    <button type="submit" class="registerbtn" name="register" value="Register">Register</button>
</center>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="admin.php">Sign in</a>.</p>
  </div>
</form>
        </form>
        <b>
        <script>
            function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
</script>
<p>Else if you have a account, just login</p>
<a href="admin.php"  type= "submit" class="btn btn-dark" name="save">Login</a>
<a href="welcome.php"  type= "submit" class="btn btn-dark" name="save">Welcome</a>
</b>
</center>

</body>
</html>
