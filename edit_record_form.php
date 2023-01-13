<?php
require('database.php');

$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$records = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" value="<?php echo $records['image']; ?>" />
            <input type="hidden" name="record_id"
                   value="<?php echo $records['recordID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $records['categoryID']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $records['name']; ?>">
            <br>

            <label>Breed:</label>
            <input type="input" name="breed"
                   value="<?php echo $records['breed']; ?>">
            <br>

            <label>Arrival:</label>
            <input type="date" name="arrival">
            <br>

            <label>Departure:</label>
            <input type="date" name="departure">
            <br>

            <label>Food:</label>
            <input type="input" name="food"
                   value="<?php echo $records['food']; ?>">
            <br>

            <label>Allergies:</label>
            <input type="input" name="allergies"
                   value="<?php echo $records['allergies']; ?>">
            <br>

            <label>Instructions:</label>
            <input type="input" name="instructions"
                   value="<?php echo $records['instructions']; ?>">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image" />
            <br>            
            <?php if ($records['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $records['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>