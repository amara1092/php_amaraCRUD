<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./styles/main.css">
</head>
<?php
require('database.php');
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$record = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>PHP CRUD</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<!-- the body section -->
<body>
<?php include './includes/header.php';?>
    <main>
        <h1>Edit record</h1>
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" value="<?php echo $record['image']; ?>" />
            <input type="hidden" name="record_id"
                   value="<?php echo $record['recordID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $record['categoryID']; ?>">
            
                   <br>
            <label>Color:</label>
            <input type="input" name="color"
                   value="<?php echo $record['color']; ?>">

               <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $record['name']; ?>">
       
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $record['price']; ?>">

              <br>
              <label>Size:</label>
              <input type="input" name="size"
              value="<?php echo $record['size']; ?>">

            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($record['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $record['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <?php include './includes/footer.php';?>
</body>
</html>