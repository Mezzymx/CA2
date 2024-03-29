<?php

// Get the record data

$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$breed = filter_input(INPUT_POST, 'breed');
$arrival = filter_input(INPUT_POST, 'arrival');
$departure = filter_input(INPUT_POST, 'departure');
$food = filter_input(INPUT_POST, 'food');
$allergies = filter_input(INPUT_POST, 'allergies');
$instructions = filter_input(INPUT_POST, 'instructions');


// Validate inputs
if ($record_id == NULL || $record_id == FALSE || $category_id == NULL ||
$category_id == FALSE || empty($name) ) {
$error = "Invalid record data. Check all fields and try again.";
include('error.php');
} else {

/**************************** Image upload ****************************/

$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');

if ($imgFile) {
$upload_dir = 'image_uploads/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
if (filter_input(INPUT_POST, 'original_image') !== "") {
unlink($upload_dir . $original_image);                    
}
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// if no image selected the old image remain as it is.
$image = $original_image; // old image from database
}

/************************** End Image upload **************************/

// If valid, update the record in the database
require_once('database.php');

$query = 'UPDATE records
SET categoryID = :category_id,
name = :name,
breed = :breed,
arrival = :arrival,
departure = :departure,
food = :food,
allergies = :allergies,
instructions = :instructions,
image = :image

WHERE recordID = :record_id';

$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->bindValue(':name', $name);
$statement->bindValue(':breed', $breed);
$statement->bindValue(':arrival', $arrival);
$statement->bindValue(':departure', $departure);
$statement->bindValue(':food', $food);
$statement->bindValue(':allergies', $allergies);
$statement->bindValue(':instructions', $instructions);
$statement->bindValue(':image', $image);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$statement->closeCursor();

// Display the Product List page
include('index.php'); 
}
?>