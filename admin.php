<?php

//login.php

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


//If the POST var "admin" exists (our submit button), then we can
//assume that the user has submitted the admin form.
if(isset($_POST['admin'])){
    
    //Retrieve the field values from our admin form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our admin table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the admin has been successful.
        if($validPassword){
            
            //Provide the user with a admin session.
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            header('Location: Manager_index.php');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
    
}
 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./styles/login.css">
</head>
<body>


<form action="admin.php" style="border:150px solid #ccc" method="post">>
  <div class="container">
  <?php include './includes/Signup_header.php';?>
    <h1>Login</h1>
    <p>Please fill in this form to Log In.</p>
    <hr>

    <label for="username"><b>Username</b></label>
    <input type="text"  id="username" placeholder="Enter Username" name="username"  pattern="[A-Za-z].{3,}" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" id="myInput" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <input type="checkbox" onclick="myFunction()">Show Password

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <center><p>By creating an account you agree to our <a href="form.php" style="color:dodgerblue">Terms & Privacy</a>.</p></center>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <input type="submit" name="admin" value="Login"><br>
        </form>

        <br>
        <br>
<b><p>Else if you dont have a account please register</p></b>
<a href="register.php"  type= "submit" class="btn btn-dark" name="save">Register</a>
<a href="welcome.php"  type= "submit" class="btn btn-dark" name="save">Welcome</a>

       
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

    </div>
  </div>
</form>

</body>
</html>