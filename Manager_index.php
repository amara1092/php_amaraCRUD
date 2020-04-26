
<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;

/**
 * Start the session.
 */
session_start();

print_r($_SESSION);

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['admin_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: admin.php');
    exit;
}


}
}
// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];
// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./styles/main.css">
</head>
<!-- the body section -->
<body>
<div class="alert alert-info">
    <strong>Info!</strong> This is the Admin Account, We can edit product here .
  </div>
<?php include './includes/Manager_Header.php';?>
<a href="http://localhost/php_amaraCRUD/?category_id=1" class="btn " role="button">Hoodies </a>
<a href="http://localhost/php_amaraCRUD/?category_id=2" class="btn " role="button">T-shirt </a>
<a href="http://localhost/php_amaraCRUD/?category_id=3" class="btn " role="button">Bottoms </a>
<a href="http://localhost/php_amaraCRUD/?category_id=4" class="btn " role="button">Jackets & Coats</a>
<a href="http://localhost/php_amaraCRUD/?category_id=5" class="btn " role="button">Tracksuits</a>
<a href="admin.php" class="btn btn-outline-danger" role="button">Sign Out</a>
<a href="index.php" class="btn btn-outline-warning" role="button">Switch</a>
<a href="userslist.php" class="btn btn-outline-warning" role="button">Display List of Users</a>
<main>
<center>
<?php include './includes/Carosel.php';?>
<main>
<?php include './includes/jumbotron.php';?>
<?php include './includes/Columns.php';?>

</div>
<aside>
<!-- display a list of categories in the sidebar-->
<h2>Categories</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href="?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of records from the database -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Color</th>
<th>Price</th>
<th>Size</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td><?php echo $record['color']; ?></td>
<td><?php echo $record['price']; ?></td>
<td><?php echo $record['size']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Edit Categories</a></p>
</section>
</main>
<?php include './includes/footer.php';?>
<div class="pictures">
          <center><h2>Brands Fetured on this Website</h2></center>
          <center>
          <img src="https://webcomicms.net/sites/default/files/clipart/174415/adidas-logo-png-transparent-images-174415-2427632.png"></img>
          <img src="https://lh3.googleusercontent.com/proxy/DigFZ9Z45Ucc2PNROJXWI0_wzwXK3CbRuRFk6fvI07_1bEyNXw0YBaKPMCo0XvFbJd4fSXX8Z3xRbX3OyyrxG5cqp_vuMCT8LurRTFXQX3iH3pNiKCw_YfPQ76HX2EquPqYyQS5_oAlneyOmYlJ0Xie40_iA8NEmpr5oIUAEd3crTudLrf54gT6FDp3LQOI-pR1TI1rzyu6jAvqKvwES"></img>
          <img src="https://kw.arabiccoupon.com/sites/default/files/styles/icon_image/public/store_icon/boohoo-2019-logo-ar-and-en-arabiccoupon-400x400.jpg?itok=4SPcbqWy"></img>
          <img src="https://dark-horse.co.za/wp-content/uploads/2014/09/DH_LOGO_Nike-400-x-400.jpg"></img>
          <img src="https://editorial.designtaxi.com/editorial-images/news-BurberryNewLogo030818/1-Burberry-New-LogoDesign.jpg"></img>
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Off-White_Logo.svg/400px-Off-White_Logo.svg.png"></img>
          <img src="https://s3.amazonaws.com/rapgenius/1354304111_Gucci-Logo1.gif"></img>
          </center>
</div>
</body>
</html>