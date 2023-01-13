<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Name:</label>
            <input type="input" name="name" placeholder="Add pet name" required>
            <br>

            <label>Breed:</label>
            <input type="input" name="breed" required>
            <br>        

            <label>Arrival:</label>
            <input type="date" name="arrival" required
                   value="<?php echo $records['arrival']; ?>">
            <br>

            <label>Departure:</label>
            <input type="date" name="departure" required
                   value="<?php echo $records['departure']; ?>">
            <br>


            <label>Food Preference</label>
            <input type="input" name="food">
            <br>

            <label>Allergies</label> 
            <input type="input" name="allergies" placeholder="Add all allergies/ irritabilities" required>
            <br>

            <label>Special Instructions</label>
            <input type="input" name="instructions" placeholder="Add special requirements">
            <br>
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Record">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>