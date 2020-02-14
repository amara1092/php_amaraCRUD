<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>My PHP CRUD application</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<!-- the body section -->
<body>
<?php include './includes/header.php';?>

    <main>
        <h1>Database Error</h1>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>
    <?php include './includes/footer.php';?>
</body>
</html>